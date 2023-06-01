<?php
/**
 * Template Name: Areas
 * The home page
 *
 */

?>

<section class="bg-primary text-white py-5 find-subhurb">
    <div class="container">
        <div class="row">
            <h3 class="Helvetica-bold text-uppercase fs-90">Find Your Suburb</h3>
            <h5>Search by alphabetical order:</h5>
        </div>
        <div class="alphabets row gx-2">
    <?php
for ($i = ord('a'); $i <= ord('z'); $i++) {
    $letter = chr($i);
    ?>
<div class="col-lg text-center char-filter px-3 py-2 text-uppercase" role="button" data-char="<?=strtoupper($letter)?>"><?=$letter?></div>
    <?php
}
?>
</div>
    </div>
</section>

<section class="areas py-lg-5">

<div class="container">

<?php
$template = 'views/suburbs-template-blade.php'; // replace with your desired template filename


$args = array(
    'posts_per_page'   => -1,
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'title',
    'meta_query' => array(
        array(
            'key' => '_wp_page_template',
            'value' => $template // Replace with the name of the template you're searching for
        )
    )
);
$pages_with__cat_template = get_posts( $args );
?>
<ul class="row mb-5 listing-upper">
    <li class="col-lg filter-cat btn rounded-0 btn-outline-primary text-uppercase active" data-id="all" >Show all</li>
    <?php foreach ( $pages_with__cat_template as $page ) :?>
        <li class="col-lg filter-cat btn rounded-0 btn-outline-primary text-uppercase" data-id="<?=$page->ID?>">
            <?php echo get_the_title( $page->ID ); ?>
        </li>
    <?php endforeach; ?>
</ul>


<?php
$template = 'views/suburbs-template-blade.php'; // replace with your desired template filename

$args = array(
    'posts_per_page'   => -1,
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'title',
    'meta_query' => array(
        array(
            'key' => '_wp_page_template',
            'value' => $template // Replace with the name of the template you're searching for
        )
    )
);
$pages_with_template = get_posts( $args );
?>
<ul class="row listing-lower">
    <?php foreach ( $pages_with_template as $page ) :
        $parent_id = wp_get_post_parent_id( $page->ID );
        $areaname = get_the_title( $page->ID );
        ?>
    <li class="col-lg-3 areas-list char-<?=strtoupper($areaname[0])?> parent-<?=$parent_id?>">
    <a class="Helvetica-bold fs-18" href="<?php echo get_permalink( $page->ID ); ?>">
        <?php echo $areaname; ?>
    </a>
</li>
    <?php endforeach; ?>
</ul>
</div>
</section>
<?php
get_footer();
?>
