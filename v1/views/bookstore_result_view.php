<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * book search result to JS AJAX view
 * 
 */
?>
<div class="products">
                <?php
                if($data['s_function']  == "searchbyname"){
                    if(empty($data['s_term'])){
                        echo '<h3>Books</h3>';
                    }else{
                        echo '<h3>Search results for "'.$data['s_term'].'"</h3>';
                    }
                    
                }else if($data['s_function']  == "searchbyauthor"){
                    if(empty($data['s_term'])){
                        echo '<h3>Books</h3>';
                    }else{
                        echo '<h3>Books by "'.$data['s_term'].'"</h3>';
                    }
                    
                }else{
                    echo '<h3>Latest Books</h3>';
                }
                
                ?>
               
                <ul style="overflow: auto">
                   <?php
                   //displaying loaded book list
                   //var_dump($data);
                   foreach ($data['res'] as $key => $book) {
                       $price = explode(".", $book['price']);
                       echo '
                            <li>
                               <div class="product">
                                  <a href="'.$this->baseURL.'bookstore/book/'.$book['book_code'].'" class="info">
                                  <span class="holder">
                                  <img src="'.$this->baseURL.'media/books/'.$book['img_name'].'" alt="" />
                                  <span class="book-name">'.$book['book_name'].'</span>
                                  <span class="author">'.$book['author'].'</span>
                                  </span>
                                  </a>
                                  <a href="'.$this->baseURL.'cart/addbook/'.$book['book_code'].'" class="buy-btn">
                                      <span>BUY NOW</span>
                                      <span class="price"><span class="low">'.$this->currency.'</span>'.$price[0].'<span class="high">'.$price[1].'</span></span></a>
                               </div>
                            </li>                           
                           ';
                       
                   }                   
                   ?>                                  
                  
               </ul>
               <div id="search_nav">
                <?php
                    if($data['pno'] >1 ){
                        echo '<button onclick="search_book(\''.$data['s_term'].'\',\''.$data['s_function'].'\','.($data['pno']-1).')" >Back</button>';
                    }else{
                        //echo '<button>>>></button>';
                    }
                    if(sizeof($data['res']) > 11 ){
                        echo '<button style="float:right;" onclick="search_book(\''.$data['s_term'].'\',\''.$data['s_function'].'\','.($data['pno']+1).')" >Next</button>';
                    }else{
                        // echo '<button style="float:right;" ><<<</button>';
                    }
                ?> 
                </div>
               
            </div>