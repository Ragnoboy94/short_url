<?php
class UrlModel extends Model {
    public function createShortUrl($longUrl) {
        $shortCode = $this->generateShortCode();
        $query = $this->db->getConnection()->prepare("INSERT INTO urls (long_url, short_code) VALUES (?, ?)");
        $query->bind_param("ss", $longUrl, $shortCode);
        $query->execute();

        return $shortCode;
    }

    private function generateShortCode() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 6; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public function getLongUrl($shortCode) {
        $query = $this->db->getConnection()->prepare("SELECT long_url FROM urls WHERE short_code = ?");
        $query->bind_param("s", $shortCode);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['long_url'];
        } else {
            return null;
        }
    }
}
