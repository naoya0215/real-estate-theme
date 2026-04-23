<?php get_header(); ?>

<main class="property-archive">
    <div class="container">
        <h1>物件一覧</h1>

        <?php if (have_posts()) : ?>
            <div class="property-list">
                <?php while (have_posts()) : the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="property-card">
    
                        <?php 
                        $main_image = get_field('main_image');
                        if ($main_image) : ?>
                            <div class="property-card__image">
                                <img src="<?php echo $main_image['url']; ?>" alt="<?php echo $main_image['alt']; ?>">
                            </div>
                        <?php endif; ?>

                        <div class="property-card__body">
                            <h2 class="property-card__title"><?php the_title(); ?></h2>
                            <ul class="property-card__info">
                                <li>賃料：<?php echo get_field('rent'); ?>円</li>
                                <li>間取り：<?php echo get_field('layout'); ?></li>
                                <li>専有面積：<?php echo get_field('area'); ?>㎡</li>
                                <li>最寄り駅：<?php echo get_field('nearest_station'); ?> 徒歩<?php echo get_field('walk_minutes'); ?>分</li>
                            </ul>
                        </div>

                    </a>
                <?php endwhile; ?>
            </div>

            <?php the_posts_pagination(); ?>

        <?php else : ?>
            <p>物件が見つかりませんでした。</p>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>