<?php


namespace App\Models;


class Pagination
{
    public function pageList($href,$qtd,$page,$limit){
        $total_pages = ceil($qtd / $limit);
        if($total_pages >= $page && $page > 1){
            ?>
            <li class="page-item">
                <a class="page-link" href='<?php echo $href?>?page=<?php echo $page-1;?>' aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
        }
        $nextpage = false;
        if($total_pages <= 5){
            $pages = $total_pages;
        }else{
            if($page+4 > $total_pages){
                $pages = $total_pages;
            }else{
                $pages = $page+4;
                $nextpage = $pages;
            }
        }
        if(!empty($pages)){
            for($i=$page; $i<=$pages; $i++){
                if($i == $page){
                    ?><li class="page-item active"><a class="page-link" href='<?php echo $href?>?page=<?php echo $i;?>'><?php echo $i;?></a></li><?php
                }else{
                    ?><li class="page-item"><a class="page-link" href='<?php echo $href?>?page=<?php echo $i;?>'><?php echo $i;?></a></li><?php
                }
            }
            if($page <> $pages && $nextpage){
                ?>
                <li class="page-item">
                    <a class="page-link" href='<?php echo $href?>?page=<?php echo $nextpage+1;?>' aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php
            }
        }
    }
}