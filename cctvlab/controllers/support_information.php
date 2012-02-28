<?php

class Support_information extends Public_Controller {
    public function index()
    {

            $this->template->set_layout(FALSE)
                 ->build('information');
    }
}