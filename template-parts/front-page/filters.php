<form method="post" id="section_selects">    
            <select name="categorie" class="wrapper_select_boxes" id="categorie">
                <option class="title_filter_box"value="">Catégories</option>
                <?php 
                    $terms = get_terms( array(
                        'taxonomy'   => 'categoriies',
                        'hide_empty' => false,
                    ) );
                    foreach($terms as $term){
                        echo '<option value="' . $term->slug .'">' . $term->name . '</option>';
                    }
                ?>
            </select>

            <select name="format"  id="format" class="wrapper_select_boxes">
                <option value="">Formats</option>
                <?php 
                    $terms = get_terms( array(
                        'taxonomy'   => 'formats',
                        'hide_empty' => false,
                    ) );
                    foreach($terms as $term){
                        echo '<option value="' . $term->slug .'">' . $term->name . '</option>';
                    }
                ?>
            </select>

            <select name="date" id="date" class="wrapper_select_boxes">
                <option value="0">Trier par</option>
                <option value="1">Plus récent</option>
                <option value="2">Plus ancien</option>
            </select>
        </form>