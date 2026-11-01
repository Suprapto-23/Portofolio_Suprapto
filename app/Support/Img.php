<?php

namespace App\Support;

class Img
{
    /** URL gambar pertama yang ADA di public/ untuk kunci di config/portfolio_site.php, atau null. */
    public static function url(string $key): ?string
    {
        foreach ((array) config("portfolio_site.images.$key", []) as $path) {
            if (is_file(public_path($path))) {
                return asset($path);
            }
        }

        return null;
    }

    /**
     * Cari file di public/. Jika path persis tidak ada, coba ekstensi lain
     * (jpg, jpeg, png, webp) dengan nama yang sama. Mengembalikan path yang ditemukan atau null.
     */
    public static function resolve(?string $path): ?string
    {
        if (! is_string($path) || $path === '') {
            return null;
        }

        if (is_file(public_path($path))) {
            return $path;
        }

        $info = pathinfo($path);
        $base = (($info['dirname'] ?? '.') !== '.' ? $info['dirname'] . '/' : '') . ($info['filename'] ?? '');

        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            if (is_file(public_path("$base.$ext"))) {
                return "$base.$ext";
            }
        }

        return null;
    }

    /**
     * Saring daftar foto: hanya yang filenya ada di public/.
     *
     * Menerima:
     *   - null / '' / array kosong         => []
     *   - 'images/foto.jpg'                => satu foto tanpa keterangan
     *   - ['images/a.jpg', 'images/b.jpg'] atau [['images/a.jpg', 'Keterangan'], ...]
     *
     * Hasil selalu berupa array baris [path, keterangan]. Path sudah disesuaikan
     * dengan file yang benar-benar ada (mis. .png ditulis di config tetapi file-nya .jpg).
     */
    public static function existing(mixed $rows): array
    {
        if ($rows === null || $rows === '' || $rows === false) {
            return [];
        }

        if (is_string($rows)) {
            $rows = [$rows];
        }

        if (! is_iterable($rows)) {
            return [];
        }

        $out = [];
        foreach ($rows as $row) {
            if (is_string($row)) {
                $row = [$row, ''];
            }

            $row   = (array) $row;
            $found = self::resolve($row[0] ?? null);

            if ($found !== null) {
                $row[0] = $found;
                $out[]  = $row;
            }
        }

        return $out;
    }
}