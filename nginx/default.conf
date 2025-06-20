server {
    listen 80;
    server_name localhost;
    root /var/www/html/public; # FuelPHPのpublicディレクトリをドキュメントルートに設定

    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        # FuelPHPのpublic/index.phpにリクエストを渡すための設定
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass app:9000; # appサービス (php-fpm) の9000ポートにリクエストを転送
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }

    # 禁止するディレクトリやファイル（必要に応じて追加）
    location ~ /\.ht {
        deny all;
    }
}