
<?php
class Response {
    private $status;
    private $headers = [];

    public function setStatus($code) {
        $this->status = $code;
        http_response_code($code);
    }

    public function addHeader($header) {
        $this->headers[] = $header;
    }

    public function send($content) {
        ob_clean();
        foreach ($this->headers as $header) {
            header($header);
        }
        echo $content;
        ob_end_flush();
    }
}
?>
