<?php
?>

<div class="search">
    <form class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
        <input 
            id="search" 
            type="search" 
            name="s" 
            placeholder="Search for a movie..." 
            class="search-input" 
            value="<?php echo esc_attr(get_search_query()); ?>" 
        />
    </form>
</div>

  
