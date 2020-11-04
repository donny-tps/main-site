<?php
add_action('admin_menu', function(){
add_menu_page( 'Magazine Category', 'Magazine', 'manage_options', 'magazine-options', 'magazine_setting', '', 4 );
} );
function magazine_setting(){
    global $pagenow;
    if ( isset ( $_GET['tab'] ) )
        magazine_created_tabs($_GET['tab']);
    else
        magazine_created_tabs('magazine');

    if ( $pagenow == 'admin.php' && $_GET['page'] == 'magazine-options' ) {

        if (isset ($_GET['tab']))
            $tab = $_GET['tab'];
        else
            $tab = 'magazine';
        switch ($tab) {
            case 'magazine' :
                ?>
                    <form action="options.php" method="POST" id="magazineForm">
                        <?php
                            settings_fields("magazine-options");
                            do_settings_sections("magazine-options");
                            submit_button();
                        ?>
                    </form>
                <?php
                break;
            default :
                ?>
                <h1>Default Case</h1>
                <?php
        }
    }
}
add_action( 'admin_init', 'eg_settings_api_init' );
function eg_settings_api_init() {
    add_settings_section(
        'section_magazine_categories', // section
        'Select Post Categories to Include in the filter',
        'magazine_section_callback_function',
        'magazine-options' // page
    );
    add_settings_field(
        'magazine_categories',
        '',
        'magazine_categories_callback_function',
        'magazine-options', // page
        'section_magazine_categories' // section
    );
    add_settings_field(
        'magazine_categories_json',
        '',
        'magazine_categories_json_callback_function',
        'magazine-options', // page
        'section_magazine_categories' // section
    );
    register_setting( 'magazine-options', 'magazine_selected_categories' );
    register_setting( 'magazine-options', 'magazine_selected_categories_json' );
}

function magazine_section_callback_function() {
    $categories = get_categories(['parent'=>0]);
    $saved_categories = explode(',', get_option( 'magazine_selected_categories' ) );
    ?>
    <div style="display: none;"><?php var_dump( $categories );?></div>
        <ul>
            <?php foreach($categories as $category) : ?>
                <li>
                    <label>
                        <?php if( in_array($category->term_id, $saved_categories) ) : ?>
                            <input class="category-item" type="checkbox" data-subcat="top" value="<?= $category->term_id; ?>" checked>
                        <?php else : ?>
                            <input class="category-item" type="checkbox" data-subcat="top" value="<?= $category->term_id; ?>">
                        <?php endif; ?>
                        <?= $category->name; ?>
                    </label>
                    <?php $sub_cats = get_categories([ 'parent'=>$category->term_id ]); ?>
                    <ul style="margin-left: 20px;">
                    <?php foreach($sub_cats as $sub_cat) : ?>
                            <li>
                                <label>
                                    <?php if( in_array($sub_cat->term_id, $saved_categories) ) : ?>
                                        <input class="category-item" type="checkbox" data-subcat="<?= $category->term_id; ?>" value="<?= $sub_cat->term_id; ?>" checked>
                                    <?php else : ?>
                                        <input class="category-item" type="checkbox" data-subcat="<?= $category->term_id; ?>" value="<?= $sub_cat->term_id; ?>">
                                    <?php endif; ?>
                                    <?= $sub_cat->name; ?>
                                </label>
                                <?php $sub_sub_cats = get_categories([ 'parent'=>$sub_cat->term_id ]); ?>
                                <ul style="margin-left: 20px;">
                                    <?php foreach($sub_sub_cats as $sub_sub_cat) : ?>
                                        <li>
                                            <label>
                                                <?php if( in_array($sub_sub_cat->term_id, $saved_categories) ) : ?>
                                                    <input class="category-item" type="checkbox"  data-subcat="<?= $sub_cat->term_id; ?>"value="<?= $sub_sub_cat->term_id; ?>" checked>
                                                <?php else : ?>
                                                    <input class="category-item" type="checkbox"  data-subcat="<?= $sub_cat->term_id; ?>"value="<?= $sub_sub_cat->term_id; ?>">
                                                <?php endif; ?>
                                                <?= $sub_sub_cat->name; ?>
                                            </label>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    <script>
        jQuery(function($){
            $('#magazineForm').submit(function(e){
//                e.preventDefault();
                var categories = [];
                var categoriesJson = {};
                $('.category-item:checked').each(function(i, el){
                    categories.push(el.value);
                    if( $(el).attr('data-subcat') in categoriesJson ) {
                        categoriesJson[$(el).attr('data-subcat')].push(el.value);
                    } else {
                        categoriesJson[$(el).attr('data-subcat')] = [];
                        categoriesJson[$(el).attr('data-subcat')].push(el.value);
                    }
                });
//                console.log(categoriesJson);
                $('#saveCategory').val(categories.join(','));
                $('#saveCategoryJson').val(JSON.stringify(categoriesJson));
            });
        });
    </script>
    <?php
}

function magazine_categories_callback_function() {
    echo '<input
		name="magazine_selected_categories"
		type="hidden"
		value="' . get_option( 'magazine_selected_categories' ) . '"
		id="saveCategory"
	 />';
}

function magazine_categories_json_callback_function() {
    echo '<input
		name="magazine_selected_categories_json"
		type="hidden"
		value="' . get_option( 'magazine_selected_categories_json' ) . '"
		id="saveCategoryJson"
	 />';
}

function magazine_created_tabs( $current = 'magazine' ) {
    $tabs = array( 'magazine' => 'Magazine Categories' );
    echo '<h2 class="nav-tab-wrapper clearfix">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=magazine-options&tab=$tab'>$name</a>";
    }
    echo '</h2>';
}