<?php 

namespace App;

use Illuminate\Pagination\BootstrapThreePresenter;

class ProductTagPaginationLinks extends BootstrapThreePresenter {

    public function getActivePageWrapper($text)
    {
        return '<li class="active"><span>'.$text.'</span></li>';
    }

    public function getDisabledTextWrapper($text)
    {
        return '<li class="disabled"><a href="#">'.$text.'</a></li>';
    }

    public function getPageLinkWrapper($url, $page, $rel = null)
    {            
        $url = str_replace('.html', '', $url);
        $arr = @explode('/', $url);
        $link = $arr[0] .'//' . $arr[2] . '/' . $arr[3] . '/' . $arr[4] . '/trang-' . $page . '.html';
        
        if ($this->currentPage() === $page) {
            return '<li class="active"><span>'.$page.'</span></li>';
        } else {
            return '<li><a href="'.$link.'">'.$page.'</a></li>';
        }
    }

    public function render()
    {
        if ($this->hasPages())
        {
            return sprintf(
                '%s %s %s',
                $this->getPreviousButton(),
                $this->getLinks(),
                $this->getNextButton()
            );
        }

        return '';
    }

}