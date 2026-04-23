<?php get_header(); ?>

<main class="property-single">
    <div class="container">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <h1><?php the_title(); ?></h1>

            <?php 
            $main_image = get_field('main_image');
            if ($main_image) : ?>
                <div class="property-single__image">
                    <img src="<?php echo $main_image['url']; ?>" alt="<?php echo $main_image['alt']; ?>">
                </div>
            <?php endif; ?>

            <div class="property-single__info">
                <table>
                    <tr>
                        <th>賃料</th>
                        <td><?php echo get_field('rent'); ?>円</td>
                    </tr>
                    <tr>
                        <th>管理費</th>
                        <td><?php echo get_field('management_fee'); ?>円</td>
                    </tr>
                    <tr>
                        <th>敷金</th>
                        <td><?php echo get_field('deposit'); ?>ヶ月</td>
                    </tr>
                    <tr>
                        <th>礼金</th>
                        <td><?php echo get_field('key_money'); ?>ヶ月</td>
                    </tr>
                    <tr>
                        <th>間取り</th>
                        <td><?php echo get_field('layout'); ?></td>
                    </tr>
                    <tr>
                        <th>専有面積</th>
                        <td><?php echo get_field('area'); ?>㎡</td>
                    </tr>
                    <tr>
                        <th>築年数</th>
                        <td><?php echo get_field('built_year'); ?>年</td>
                    </tr>
                    <tr>
                        <th>建物種別</th>
                        <td><?php echo get_field('building_type'); ?></td>
                    </tr>
                    <tr>
                        <th>入居可能日</th>
                        <td><?php echo get_field('move_in_date'); ?></td>
                    </tr>
                    <tr>
                        <th>都道府県</th>
                        <td><?php echo get_field('prefecture'); ?></td>
                    </tr>
                    <tr>
                        <th>市区町村</th>
                        <td><?php echo get_field('city'); ?></td>
                    </tr>
                    <tr>
                        <th>番地</th>
                        <td><?php echo get_field('address'); ?></td>
                    </tr>
                    <tr>
                        <th>最寄り駅</th>
                        <td><?php echo get_field('nearest_station'); ?> 徒歩<?php echo get_field('walk_minutes'); ?>分</td>
                    </tr>
                    <tr>
                        <th>ペット可</th>
                        <td><?php echo get_field('pet_allowed') ? '可' : '不可'; ?></td>
                    </tr>
                    <tr>
                        <th>駐車場</th>
                        <td><?php echo get_field('parking') ? 'あり' : 'なし'; ?></td>
                    </tr>
                    <tr>
                        <th>オートロック</th>
                        <td><?php echo get_field('auto_lock') ? 'あり' : 'なし'; ?></td>
                    </tr>
                    <tr>
                        <th>エアコン</th>
                        <td><?php echo get_field('air_conditioner') ? 'あり' : 'なし'; ?></td>
                    </tr>
                    <tr>
                        <th>バス・トイレ別</th>
                        <td><?php echo get_field('separate_bath_toilet') ? 'あり' : 'なし'; ?></td>
                    </tr>
                </table>
            </div>

            <?php 
            $sub_images = get_field('sub_images');
            if ($sub_images) : ?>
                <div class="property-single__gallery">
                    <?php foreach ($sub_images as $sub_image) : ?>
                        <img src="<?php echo $sub_image['url']; ?>" alt="<?php echo $sub_image['alt']; ?>">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        <?php endwhile; endif; ?>

        <a href="<?php echo home_url('/property/'); ?>">← 物件一覧に戻る</a>

    </div>
</main>

<?php get_footer(); ?>