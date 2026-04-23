<?php get_header(); ?>

<!-- ヒーローエリア -->
<section class="hero">
    <div class="hero__inner">
        <p class="hero__sub">理想の住まいを探そう</p>
        <h1 class="hero__title">あなたにぴったりの<br>物件が見つかる</h1>
        <a href="<?php echo home_url('/property/'); ?>" class="hero__btn">物件を探す</a>
    </div>
</section>

<!-- 新着物件 -->
<section class="pickup">
    <div class="container">
        <h2 class="section-title">新着物件</h2>

        <div class="property-list">
            <?php
            $args = array(
                'post_type'      => 'property',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>

                    <a href="<?php the_permalink(); ?>" class="property-card">

                        <?php $main_image = get_field('main_image'); ?>
                        <div class="property-card__image">
                            <?php if ($main_image) : ?>
                                <img src="<?php echo $main_image['url']; ?>" alt="<?php echo $main_image['alt']; ?>">
                            <?php endif; ?>
                        </div>

                        <div class="property-card__body">
                            <h3 class="property-card__title"><?php the_title(); ?></h3>
                            <ul class="property-card__info">
                                <li>賃料：<?php echo get_field('rent'); ?>円</li>
                                <li>間取り：<?php echo get_field('layout'); ?></li>
                                <li>専有面積：<?php echo get_field('area'); ?>㎡</li>
                                <li>最寄り駅：<?php echo get_field('nearest_station'); ?> 徒歩<?php echo get_field('walk_minutes'); ?>分</li>
                            </ul>
                        </div>

                    </a>

                <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>

        <div class="pickup__more">
            <a href="<?php echo home_url('/property/'); ?>" class="more-btn">物件一覧をもっと見る</a>
        </div>

    </div>
</section>

<!-- サービス紹介 -->
<section class="service">
    <div class="container">
        <h2 class="section-title">私たちについて</h2>
        <div class="service__list">
            <div class="service__item">
                <div class="service__icon">🏠</div>
                <h3>豊富な物件数</h3>
                <p>東京・大阪・名古屋を中心に多数の物件を取り揃えております。</p>
            </div>
            <div class="service__item">
                <div class="service__icon">🔍</div>
                <h3>こだわり検索</h3>
                <p>間取り・賃料・エリアなど細かい条件で理想の物件を探せます。</p>
            </div>
            <div class="service__item">
                <div class="service__icon">📞</div>
                <h3>丁寧なサポート</h3>
                <p>お部屋探しから契約まで専門スタッフが丁寧にサポートします。</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>