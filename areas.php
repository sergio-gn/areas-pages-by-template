<?php
/**
 * Template Name: Areas
 * The home page
 *
 */

?>

<section>
    <div>
        <div>
            <h5>Search by alphabetical order:</h5>
        </div>
        <div>
            <?php
            for ($i = ord('a'); $i <= ord('z'); $i++) {
                $letter = chr($i);
                ?>
                <div data-char="<?= strtoupper($letter) ?>">
                    <?= $letter ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<section>
    <div>
        <?php
        $template = 'template.php';

        $args = array(
            'posts_per_page' => -1,
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
        $pages_with__cat_template = get_posts($args);
        ?>
        <ul>
            <li data-id="all">Show all</li>
            <?php foreach ($pages_with__cat_template as $page): ?>
                <li data-id="<?= $page->ID ?>">
                    <?php echo get_the_title($page->ID); ?>
                </li>
            <?php endforeach; ?>
        </ul>


        <?php
        $template = 'template.php'; // replace with your desired template filename

        $args = array(
            'posts_per_page' => -1,
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
        $pages_with_template = get_posts($args);
        ?>
        <ul>
            <?php foreach ($pages_with_template as $page):
                $parent_id = wp_get_post_parent_id($page->ID);
                $areaname = get_the_title($page->ID);
                ?>
                <li char-<?= strtoupper($areaname[0]) ?> parent-<?= $parent_id ?>">
                    <a href="<?php echo get_permalink($page->ID); ?>">
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
