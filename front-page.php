<?php get_header(); ?>

<!-- ヒーローエリア -->
<section class="hero">
    <div class="hero__inner">
        <p class="hero__sub">理想の住まいを探そう</p>
        <h1 class="hero__title">あなたにぴったりの<br>物件が見つかる</h1>

        <!-- 検索フォーム -->
        <form method="GET" action="<?php echo home_url('/property/'); ?>" class="hero__search">
            <div class="hero__search__inner">
                <div class="hero__search__item">
                    <select name="area">
                        <option value="">エリアを選ぶ</option>
                        <option value="tokyo">東京都</option>
                        <option value="osaka">大阪府</option>
                        <option value="nagoya">愛知県</option>
                    </select>
                </div>
                <div class="hero__search__item">
                    <select name="layout">
                        <option value="">間取りを選ぶ</option>
                        <option value="1R">1R</option>
                        <option value="1K">1K</option>
                        <option value="1DK">1DK</option>
                        <option value="1LDK">1LDK</option>
                        <option value="2LDK">2LDK</option>
                        <option value="3LDK">3LDK</option>
                    </select>
                </div>
                <div class="hero__search__item">
                    <select name="rent">
                        <option value="">賃料を選ぶ</option>
                        <option value="50000">〜5万円</option>
                        <option value="100000">5〜10万円</option>
                        <option value="150000">10〜15万円</option>
                        <option value="999999">15万円〜</option>
                    </select>
                </div>
                <button type="submit" class="hero__search__btn">検索する</button>
            </div>
        </form>

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