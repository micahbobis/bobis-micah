<?php
class Input {
    protected $request;
    public function __construct() {
        $this->request = request(); // global LavaLust helper
    }
    public function post($key = null) {
        return $this->request->post($key);
    }
    public function get($key = null) {
        return $this->request->get($key);
    }
}
