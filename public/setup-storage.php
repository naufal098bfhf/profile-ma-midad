<?php
/**
 * Setup Storage untuk cPanel tanpa SSH
 * File ini membantu setup storage directory untuk og:image generation
 * 
 * CARA PENGGUNAAN:
 * 1. Upload file ini ke public_html/
 * 2. Akses via browser: https://domain.com/setup-storage.php
 * 3. Ikuti instruksi yang muncul
 * 4. HAPUS file ini setelah selesai untuk keamanan
 */

// Security check - hanya bisa diakses sekali
$setupFile = __DIR__ . '/.setup-completed';
if (file_exists($setupFile)) {
    die('Setup sudah selesai. File ini sudah tidak diperlukan dan sebaiknya dihapus untuk keamanan.');
}

echo "<!DOCTYPE html>
<html>
<head>
    <title>Setup Storage - cPanel</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .success { color: #28a745; background: #d4edda; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .error { color: #dc3545; background: #f8d7da; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .warning { color: #856404; background: #fff3cd; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .info { color: #0c5460; background: #d1ecf1; padding: 15px; border-radius: 5px; margin: 10px 0; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin: 5px; }
        button:hover { background: #0056b3; }
        .code { background: #f8f9fa; padding: 10px; border-radius: 5px; font-family: monospace; }
    </style>
</head>
<body>
    <div class='container'>
        <h1>🚀 Setup Storage untuk PPDB Og:Image</h1>
        <p>Script ini akan membantu setup storage directory untuk og:image generation di cPanel.</p>";

// Check PHP version
$phpVersion = PHP_VERSION;
echo "<div class='info'><strong>PHP Version:</strong> {$phpVersion}</div>";

// Check GD extension
if (extension_loaded('gd')) {
    echo "<div class='success'>✓ GD Extension tersedia</div>";
} else {
    echo "<div class='error'>✗ GD Extension tidak tersedia - hubungi hosting provider</div>";
}

// Check if we can create directories
$testDir = __DIR__ . '/storage/test';
if (mkdir($testDir, 0755, true)) {
    rmdir($testDir);
    echo "<div class='success'>✓ Bisa membuat directory</div>";
} else {
    echo "<div class='error'>✗ Tidak bisa membuat directory - cek permissions</div>";
}

// Setup storage structure
if (isset($_POST['setup'])) {
    echo "<h2>📁 Setup Storage Structure</h2>";
    
    $directories = [
        'storage',
        'storage/ppdb',
        'storage/ppdb/og-images'
    ];
    
    $success = true;
    foreach ($directories as $dir) {
        $fullPath = __DIR__ . '/' . $dir;
        if (!is_dir($fullPath)) {
            if (mkdir($fullPath, 0755, true)) {
                echo "<div class='success'>✓ Directory dibuat: {$dir}</div>";
            } else {
                echo "<div class='error'>✗ Gagal membuat directory: {$dir}</div>";
                $success = false;
            }
        } else {
            echo "<div class='success'>✓ Directory sudah ada: {$dir}</div>";
        }
    }
    
    // Create .htaccess for security
    $htaccessContent = "# Deny access to PHP files
<Files \"*.php\">
    Order Deny,Allow
    Deny from all
</Files>

# Allow image files
<FilesMatch \"\\.(jpg|jpeg|png|gif|webp)$\">
    Order Allow,Deny
    Allow from all
</FilesMatch>";

    $htaccessPath = __DIR__ . '/storage/.htaccess';
    if (file_put_contents($htaccessPath, $htaccessContent)) {
        echo "<div class='success'>✓ File .htaccess dibuat untuk keamanan</div>";
    } else {
        echo "<div class='warning'>⚠ Gagal membuat .htaccess</div>";
    }
    
    if ($success) {
        // Mark setup as completed
        file_put_contents($setupFile, date('Y-m-d H:i:s'));
        echo "<div class='success'>
            <h3>🎉 Setup Berhasil!</h3>
            <p>Storage directory sudah siap untuk og:image generation.</p>
            <p><strong>PENTING:</strong> Hapus file setup-storage.php ini untuk keamanan!</p>
        </div>";
        
        echo "<div class='info'>
            <h4>📋 Langkah Selanjutnya:</h4>
            <ol>
                <li>Hapus file <code>setup-storage.php</code> ini</li>
                <li>Upload gambar hero_image ke folder <code>storage/</code></li>
                <li>Test og:image generation di halaman PPDB</li>
                <li>Gunakan command: <code>php artisan ppdb:check-compatibility</code></li>
            </ol>
        </div>";
    }
} else {
    echo "<h2>⚙️ Setup Storage</h2>";
    echo "<p>Klik tombol di bawah untuk membuat struktur storage yang diperlukan:</p>";
    echo "<form method='post'>
        <button type='submit' name='setup' value='1'>Setup Storage Structure</button>
    </form>";
    
    echo "<div class='info'>
        <h4>📁 Struktur yang akan dibuat:</h4>
        <div class='code'>
public_html/storage/<br>
├── ppdb/<br>
│   └── og-images/<br>
└── .htaccess
        </div>
    </div>";
    
    echo "<div class='warning'>
        <h4>⚠️ PENTING untuk Keamanan:</h4>
        <ul>
            <li>Hapus file <code>setup-storage.php</code> setelah setup selesai</li>
            <li>Pastikan folder <code>storage/</code> tidak bisa diakses langsung</li>
            <li>File .htaccess akan dibuat untuk mencegah akses PHP files</li>
        </ul>
    </div>";
}

echo "</div></body></html>";
?>
