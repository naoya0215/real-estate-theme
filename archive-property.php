<?php get_header(); ?>

<main class="property-archive">
    <div class="container">
        <h1>物件一覧</h1>

        <!-- 検索フォーム -->
        <form method="GET" action="" class="search-form">
            <div class="search-form__inner">

                <div class="search-form__item">
                    <label>エリア</label>
                    <select name="area">
                        <option value="">すべて</option>
                        <option value="tokyo" <?php selected($_GET['area'] ?? '', 'tokyo'); ?>>東京都</option>
                        <option value="osaka" <?php selected($_GET['area'] ?? '', 'osaka'); ?>>大阪府</option>
                        <option value="nagoya" <?php selected($_GET['area'] ?? '', 'nagoya'); ?>>愛知県</option>
                    </select>
                </div>

                <div class="search-form__item">
                    <label>間取り</label>
                    <select name="layout">
                        <option value="">すべて</option>
                        <option value="1R" <?php selected($_GET['layout'] ?? '', '1R'); ?>>1R</option>
                        <option value="1K" <?php selected($_GET['layout'] ?? '', '1K'); ?>>1K</option>
                        <option value="1DK" <?php selected($_GET['layout'] ?? '', '1DK'); ?>>1DK</option>
                        <option value="1LDK" <?php selected($_GET['layout'] ?? '', '1LDK'); ?>>1LDK</option>
                        <option value="2LDK" <?php selected($_GET['layout'] ?? '', '2LDK'); ?>>2LDK</option>
                        <option value="3LDK" <?php selected($_GET['layout'] ?? '', '3LDK'); ?>>3LDK</option>
                    </select>
                </div>

                <div class="search-form__item">
                    <label>賃料</label>
                    <select name="rent">
                        <option value="">すべて</option>
                        <option value="50000" <?php selected($_GET['rent'] ?? '', '50000'); ?>>〜5万円</option>
                        <option value="100000" <?php selected($_GET['rent'] ?? '', '100000'); ?>>5〜10万円</option>
                        <option value="150000" <?php selected($_GET['rent'] ?? '', '150000'); ?>>10〜15万円</option>
                        <option value="999999" <?php selected($_GET['rent'] ?? '', '999999'); ?>>15万円〜</option>
                    </select>
                </div>

                <button type="submit" class="search-form__btn">検索する</button>

            </div>
        </form>

        <?php
        // 検索条件の構築
        $meta_query = ['relation' => 'AND'];

        if (!empty($_GET['area'])) {
            $meta_query[] = [
                'key'     => 'prefecture',
                'value'   => $_GET['area'],
                'compare' => '='
            ];
        }

        if (!empty($_GET['layout'])) {
            $meta_query[] = [
                'key'     => 'layout',
                'value'   => $_GET['layout'],
                'compare' => '='
            ];
        }

        if (!empty($_GET['rent'])) {
            $rent = $_GET['rent'];
            if ($rent == '50000') {
                $meta_query[] = ['key' => 'rent', 'value' => 50000, 'compare' => '<=', 'type' => 'NUMERIC'];
            } elseif ($rent == '100000') {
                $meta_query[] = ['key' => 'rent', 'value' => [50001, 100000], 'compare' => 'BETWEEN', 'type' => 'NUMERIC'];
            } elseif ($rent == '150000') {
                $meta_query[] = ['key' => 'rent', 'value' => [100001, 150000], 'compare' => 'BETWEEN', 'type' => 'NUMERIC'];
            } elseif ($rent == '999999') {
                $meta_query[] = ['key' => 'rent', 'value' => 150001, 'compare' => '>=', 'type' => 'NUMERIC'];
            }
        }

        $args = [
            'post_type'      => 'property',
            'posts_per_page' => 12,
            'meta_query'     => $meta_query,
        ];

        $query = new WP_Query($args);
        ?>

        <?php if ($query->have_posts()) : ?>
            <div class="property-list">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="property-card">
                        <?php $main_image = get_field('main_image'); ?>
                        <div class="property-card__image">
                            <?php if ($main_image) : ?>
                                <img src="<?php echo $main_image['url']; ?>" alt="<?php echo $main_image['alt']; ?>">
                            <?php endif; ?>
                        </div>
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
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <?php the_posts_pagination(); ?>

        <?php else : ?>
            <p class="no-result">条件に合う物件が見つかりませんでした。</p>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>