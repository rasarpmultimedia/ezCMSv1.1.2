<?php
class Pagination{
	private $current_page;
	private $per_page;
	private $page_range;
	public  $mid_range =7;
	private $start_range;
	private $end_range;
	
	private $totalcount;
	private $urlpath;
	public  $addparam;
	private $link;
	public function __construct($page,$per_page,$totalcount){
		   $this->current_page =(int)$page;
		   $this->per_page 	   =(int)$per_page;
		   $this->totalcount   =(int)$totalcount;
		   $this->urlpath = ".";//$_SERVER['PHP_SELF']; 
		   $this->page_range= $this->pageRange();
	}
	public function pageOffset(){
	 //show eg page 1 = 1-1*10 = 0 offset and so on
	 $offset = ($this->current_page-1)*$this->per_page;
	 return $offset;
	}
	private function totalPages(){
		return ceil($this->totalcount/$this->per_page);
	}
	private function previousPage(){
		return $this->current_page - 1;
	}
	private function nextPage(){
		return $this->current_page + 1;
	}
	private function hasPreviousPage(){
	 return  $this->previousPage() >= 1 ? true : false;	
	}
	private function hasNextPage(){
	 return  $this->nextPage() <= $this->totalPages() ? true : false;	
	}
	private function pageRange(){
		$this->start_range = $this->current_page - floor($this->mid_range/2); 
		$this->end_range   = $this->current_page + floor($this->mid_range/2);
		
			if($this->start_range <= 0 ){
				$this->start_range = 1;
		    	$this->end_range += abs($this->start_range)+1;
			}elseif($this->end_range > $this->totalPages()){
			    $this->start_range -= $this->end_range-$this->totalPages();
		        $this->end_range   = $this->totalPages();
			}
			return range($this->start_range,$this->end_range);
	} 

// Buliding Pagination links
public function pageOfPage(){
	return "<p class =\"pgofpg\">Page: {$this->current_page} of {$this->totalPages()}</p>";
}
public function buildPagination(){
	$this->link = new  GenerateUrl;
   if($this->totalPages() >= 1 || $this->totalPages() >= 10){ 
    $list = "<div class=\"pagination\"><ol>"; 
	$list .="<li>";	
    if($this->hasPreviousPage()){	
		$list .="<span class=\"enabled\">".$this->link->buildLink("{$this->urlpath}",".","&laquo;Prev","page={$this->previousPage()},{$this->addparam}")."</span>";	
	}else {
		$list.="<span class =\"disabled\">&laquo; Prev</span>"; 
	}
		 for($i=1; $i <= $this->totalPages(); $i++) {
		 if($this->page_range[0] > 2 && $i == $this->page_range[0]) $list .= "<span>...</span>";
		 	 if($i==1 || $i==$this->totalPages()||in_array($i, $this->page_range)){ 
			  if($i != $this->current_page){
			  $list .="<span class=\"enabled\">".$this->link->buildLink("{$this->urlpath}",".", "{$i}","page=$i,{$this->addparam}")."</span>"; 
			  }else{ $list .="<span class=\"disabled\">$i</span>"; }  
	        }
		  if($this->page_range[$this->mid_range-1] < $this->totalPages()-1 && $i == $this->page_range[$this->mid_range-1])$list .= "<span>...</span>";
		}
   if($this->hasNextPage()){
	   $list .= "<span class=\"enabled\">".$this->link->buildLink("{$this->urlpath}",".", "Next &raquo;","page={$this->nextPage()},{$this->addparam}")."</span>";
   }else{
	   $list .= "<span class=\"disabled\"> Next &raquo;</span>"; 
   }
	   $list .= "</li>";
   $list .= "<ol></div>"; return $list;
    }
  }
}
