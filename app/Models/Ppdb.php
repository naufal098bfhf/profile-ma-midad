<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Ppdb extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'registration_start',
        'registration_end',
        'registration_fee',
        'quota',
        'requirements',
        'test_schedule',
        'announcement_schedule',
        'contact_phone',
        'contact_email',
        'status',
        'is_featured',
        'hero_image',
        'gallery_images',
        'facilities',
        'activities',
        'faqs',
        'documents'
    ];

    protected $casts = [
        'registration_start' => 'date',
        'registration_end' => 'date',
        'registration_fee' => 'decimal:2',
        'is_featured' => 'boolean',
        'gallery_images' => 'array',
        'facilities' => 'array',
        'activities' => 'array',
        'faqs' => 'array',
        'documents' => 'array'
    ];

    // Boot method to auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($ppdb) {
            if (empty($ppdb->slug)) {
                $ppdb->slug = Str::slug($ppdb->title);
            }
        });
        
        static::updating(function ($ppdb) {
            if ($ppdb->isDirty('title') && empty($ppdb->slug)) {
                $ppdb->slug = Str::slug($ppdb->title);
            }
        });
    }

    // Scope for active PPDB
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for featured PPDB
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Check if registration is open
    public function isRegistrationOpen()
    {
        $now = Carbon::now();
        return $now->between($this->registration_start, $this->registration_end);
    }

    // Get formatted registration period
    public function getRegistrationPeriodAttribute()
    {
        return $this->registration_start->format('d M Y') . ' - ' . $this->registration_end->format('d M Y');
    }

    // Get formatted registration fee
    public function getFormattedFeeAttribute()
    {
        if ($this->registration_fee == 0) {
            return 'Gratis';
        }
        return 'Rp ' . number_format($this->registration_fee, 0, ',', '.');
    }

    // Get status label
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'active' => 'Aktif',
            'inactive' => 'Tidak Aktif',
            'draft' => 'Draft',
            default => 'Tidak Diketahui'
        };
    }

    // Get status color
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'active' => 'success',
            'inactive' => 'danger',
            'draft' => 'warning',
            default => 'secondary'
        };
    }

    /**
     * Get the documents for the PPDB.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(PpdbDocument::class);
    }

    /**
     * Get active documents for the PPDB.
     */
    public function activeDocuments(): HasMany
    {
        return $this->hasMany(PpdbDocument::class)->active()->ordered();
    }

    /**
     * Get required documents for the PPDB.
     */
    public function requiredDocuments(): HasMany
    {
        return $this->hasMany(PpdbDocument::class)->required()->active()->ordered();
    }

    /**
     * Get the FAQs for the PPDB.
     */
    public function faqs(): HasMany
    {
        return $this->hasMany(PpdbFaq::class);
    }

    /**
     * Get active FAQs for the PPDB.
     */
    public function activeFaqs(): HasMany
    {
        return $this->hasMany(PpdbFaq::class)->active()->ordered();
    }

    /**
     * Get the activities for the PPDB.
     */
    public function activities(): HasMany
    {
        return $this->hasMany(PpdbActivity::class);
    }

    /**
     * Get active activities for the PPDB.
     */
    public function activeActivities(): HasMany
    {
        return $this->hasMany(PpdbActivity::class)->active()->ordered();
    }

    // Helper method to find the actual path of hero_image
    private function getHeroImagePath()
    {
        if (!$this->hero_image) {
            return null;
        }

        // Try different possible paths for hero_image
        $possiblePaths = [
            // Direct path as stored in database
            public_path('storage/' . $this->hero_image),
            // Common cPanel storage paths
            public_path('storage/ppdb/hero/' . basename($this->hero_image)),
            storage_path('app/public/' . $this->hero_image),
            storage_path('app/public/ppdb/hero/' . basename($this->hero_image)),
            // Laravel storage link paths
            public_path('storage/ppdb/' . basename($this->hero_image)),
            public_path('storage/' . basename($this->hero_image))
        ];
        
        foreach ($possiblePaths as $path) {
            if (file_exists($path) && is_readable($path)) {
                return $path;
            }
        }
        
        return null;
    }

    // Get optimized og:image URL (Auto-generate on page load)
    public function getOgImageUrlAttribute()
    {
        if (!$this->hero_image) {
            return null;
        }

        $ogImagePath = 'ppdb/og-images/' . pathinfo($this->hero_image, PATHINFO_FILENAME) . '_og.jpg';
        $ogImageFullPath = public_path('storage/' . $ogImagePath);

        // Auto-generate og:image if it doesn't exist (on every page load)
        if (!file_exists($ogImageFullPath)) {
            $this->autoGenerateOgImage();
        }

        // Return og:image URL (will be generated if it doesn't exist)
        if (file_exists($ogImageFullPath)) {
            return asset('storage/' . $ogImagePath);
        }

        // Fallback to original image if og:image generation fails
        return asset('storage/' . $this->hero_image);
    }

    // Auto-generate og:image method (called automatically)
    private function autoGenerateOgImage()
    {
        if (!$this->hero_image) {
            return false;
        }

        $ogImagePath = 'ppdb/og-images/' . pathinfo($this->hero_image, PATHINFO_FILENAME) . '_og.jpg';
        $ogImageFullPath = public_path('storage/' . $ogImagePath);

        // Skip if already exists
        if (file_exists($ogImageFullPath)) {
            return true;
        }

        // Find the actual image path
        $originalImagePath = $this->getHeroImagePath();
        if (!$originalImagePath) {
            return false;
        }

        try {
            // Create directory if not exists (with proper permissions)
            $directory = public_path('storage/ppdb/og-images');
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            // Generate og:image using native GD (more reliable for cPanel)
            $this->generateOgImageWithGd($originalImagePath, $ogImageFullPath);
            
            // Set proper file permissions for cPanel
            if (file_exists($ogImageFullPath)) {
                chmod($ogImageFullPath, 0644);
            }

            return true;
            
        } catch (\Exception $e) {
            // Log error for debugging (if logging is available)
            if (function_exists('error_log')) {
                error_log('PPDB Auto OG Image Error: ' . $e->getMessage());
            }
            
            return false;
        }
    }

    // Alternative method using native PHP GD (cPanel fallback)
    public function getOgImageUrlGdAttribute()
    {
        if (!$this->hero_image) {
            return null;
        }

        $ogImagePath = 'ppdb/og-images/' . pathinfo($this->hero_image, PATHINFO_FILENAME) . '_og_gd.jpg';
        $ogImageFullPath = public_path('storage/' . $ogImagePath);

        // Check if og:image already exists
        if (file_exists($ogImageFullPath)) {
            return asset('storage/' . $ogImagePath);
        }

        // Create og:image if original exists
        $originalImagePath = $this->getHeroImagePath();
        if ($originalImagePath) {
            try {
                // Create directory if not exists
                $directory = public_path('storage/ppdb/og-images');
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                // Check if GD extension is available
                if (!extension_loaded('gd')) {
                    return asset('storage/' . $this->hero_image);
                }

                // Get image info
                $imageInfo = getimagesize($originalImagePath);
                if (!$imageInfo) {
                    return asset('storage/' . $this->hero_image);
                }

                // Create image resource based on type
                switch ($imageInfo[2]) {
                    case IMAGETYPE_JPEG:
                        $sourceImage = imagecreatefromjpeg($originalImagePath);
                        break;
                    case IMAGETYPE_PNG:
                        $sourceImage = imagecreatefrompng($originalImagePath);
                        break;
                    case IMAGETYPE_GIF:
                        $sourceImage = imagecreatefromgif($originalImagePath);
                        break;
                    default:
                        return asset('storage/' . $this->hero_image);
                }

                if (!$sourceImage) {
                    return asset('storage/' . $this->hero_image);
                }

                // Create new image with target dimensions
                $newImage = imagecreatetruecolor(1200, 630);
                
                // Create background color (#0d9488)
                $bgColor = imagecolorallocate($newImage, 13, 148, 136);
                imagefill($newImage, 0, 0, $bgColor);

                // Calculate position to center the image
                $sourceWidth = imagesx($sourceImage);
                $sourceHeight = imagesy($sourceImage);
                
                // Calculate scaling to fit within 1200x630 while maintaining aspect ratio
                $scale = min(1200 / $sourceWidth, 630 / $sourceHeight);
                $newWidth = intval($sourceWidth * $scale);
                $newHeight = intval($sourceHeight * $scale);
                
                $x = (1200 - $newWidth) / 2;
                $y = (630 - $newHeight) / 2;

                // Resize and copy image
                imagecopyresampled($newImage, $sourceImage, $x, $y, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight);

                // Save the new image
                imagejpeg($newImage, $ogImageFullPath, 85);
                
                // Set proper file permissions
                chmod($ogImageFullPath, 0644);

                // Clean up memory
                imagedestroy($sourceImage);
                imagedestroy($newImage);

                return asset('storage/' . $ogImagePath);
                
            } catch (\Exception $e) {
                // Fallback to original image if processing fails
                return asset('storage/' . $this->hero_image);
            }
        }

        return null;
    }

    // Helper method to generate og:image using native GD
    private function generateOgImageWithGd($sourcePath, $targetPath)
    {
        // Check if GD extension is available
        if (!extension_loaded('gd')) {
            throw new \Exception('GD extension is not available');
        }

        // Get image info
        $imageInfo = getimagesize($sourcePath);
        if (!$imageInfo) {
            throw new \Exception('Cannot read image information');
        }

        // Create image resource based on type
        switch ($imageInfo[2]) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $sourceImage = imagecreatefromgif($sourcePath);
                break;
            default:
                throw new \Exception('Unsupported image type');
        }

        if (!$sourceImage) {
            throw new \Exception('Cannot create image resource');
        }

        // Create new image with target dimensions (1200x630)
        $newImage = imagecreatetruecolor(1200, 630);
        
        // Create background color (#0d9488 - brand color)
        $bgColor = imagecolorallocate($newImage, 13, 148, 136);
        imagefill($newImage, 0, 0, $bgColor);

        // Calculate position to center the image
        $sourceWidth = imagesx($sourceImage);
        $sourceHeight = imagesy($sourceImage);
        
        // Calculate scaling to fit within 1200x630 while maintaining aspect ratio
        $scale = min(1200 / $sourceWidth, 630 / $sourceHeight);
        $newWidth = intval($sourceWidth * $scale);
        $newHeight = intval($sourceHeight * $scale);
        
        $x = (1200 - $newWidth) / 2;
        $y = (630 - $newHeight) / 2;

        // Resize and copy image
        imagecopyresampled($newImage, $sourceImage, $x, $y, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight);

        // Save the new image with high quality
        $result = imagejpeg($newImage, $targetPath, 85);
        
        // Set proper file permissions
        chmod($targetPath, 0644);

        // Clean up memory
        imagedestroy($sourceImage);
        imagedestroy($newImage);

        if (!$result) {
            throw new \Exception('Failed to save og:image');
        }
    }
}
