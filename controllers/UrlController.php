<?php
class UrlController extends Controller {
    private $urlModel;

    public function __construct() {
        parent::__construct();
        $this->urlModel = new UrlModel();
    }

    public function showForm() {
        $this->view->render('form');
    }

    public function shortenUrl() {
        $longUrl = $_POST['url'] ?? '';
        if (filter_var($longUrl, FILTER_VALIDATE_URL)) {
            $shortCode = $this->urlModel->createShortUrl($longUrl);
            echo "Shortened URL: " . $shortCode;
        } else {
            echo "Invalid URL";
        }
    }

    public function apiShortenUrl() {
        $data = json_decode(file_get_contents('php://input'), true);
        $longUrl = $data['url'] ?? '';
        if (filter_var($longUrl, FILTER_VALIDATE_URL)) {
            $shortCode = $this->urlModel->createShortUrl($longUrl);
            echo json_encode(["shortUrl" => $shortCode]);
        } else {
            echo json_encode(["error" => "Invalid URL"]);
        }
    }

    public function redirectUrl($shortCode) {
        $longUrl = $this->urlModel->getLongUrl($shortCode);
        if ($longUrl) {
            header("Location: " . $longUrl);
            exit;
        } else {
            echo "URL not found";
        }
    }
}