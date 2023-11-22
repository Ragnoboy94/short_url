<?php
class View {
    public function render($viewName) {
        include "views/$viewName.php";
    }
}