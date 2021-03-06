<?php
function blog_classic_style($atts, $current)
{
    global $post, $mk_options;
    extract($atts);
    $image_height = $grid_image_height;
    $orientation  = get_post_meta($post->ID, '_classic_orientation', true);
    switch ($orientation) {
        case 'landscape':
            $orientation_class = 'mk-blog-landscape';
            if ($layout == 'full') {
                $image_width = $grid_width - 42;
            } else {
                $image_width = (($content_width / 100) * $grid_width) - 42;
            }
            break;
        case 'portraite':
            $orientation_class = 'mk-blog-portraite';
            if ($layout == 'full') {
                $image_width = 550;
            } else {
                $image_width = 400;
            }
            break;
        default:
            $orientation_class = 'mk-blog-landscape';
            if ($layout == 'full') {
                $image_width = $grid_width;
            } else {
                $image_width = (($content_width / 100) * $grid_width);
            }
    }
    $output          = $has_image = '';
    $post_type       = get_post_meta($post->ID, '_single_post_type', true);
    $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
    if ($post_type == '') {
        $post_type = 'image';
    }
    $output .= '<article id="' . get_the_ID() . '" class="mk-blog-classic-item mk-isotop-item ' . $post_type . '-post-type ' . $orientation_class . '">' . "\n";
    if ($post_type == 'image' || $post_type == 'portfolio' || $post_type == '') {
        if (has_post_thumbnail()) {
            $image_src     = bfi_thumb($image_src_array[0], array(
                'width' => $image_width,
                'height' => $image_height
            ));
            $show_lightbox = get_post_meta($post->ID, '_disable_post_lightbox', true);
            if (($show_lightbox == 'true' || $show_lightbox == '') && $disable_lightbox == 'true') {
                $lightbox_code = ' class="mk-lightbox blog-classic-lightbox" href="' . $image_src_array[0] . '"';
            } else {
                $lightbox_code = ' href="' . get_permalink() . '"';
            }
            $output .= '<div class="featured-image"><a data-title="' . get_the_title() . '"' . $lightbox_code . '>';
            $output .= '<img alt="' . get_the_title() . '" title="' . get_the_title() . '" src="' . $image_src . '" itemprop="image" />';
            $output .= '<div class="image-hover-overlay"></div>';
            $output .= '<div class="post-type-badge" href="' . get_permalink() . '"><i class="mk-jupiter-icon-' . $post_type . '"></i></div>';
            $output .= '</a></div>';
        }
    }
    if ($post_type == 'video') {
        $video_id   = get_post_meta($post->ID, '_single_video_id', true);
        $video_site = get_post_meta($post->ID, '_single_video_site', true);
        $output .= '<div class="featured-image">';
        if ($video_site == 'vimeo') {
            $output .= '<div class="mk-video-wrapper"><div class="mk-video-container"><iframe src="http'.((is_ssl())? 's' : '').'://player.vimeo.com/video/' . $video_id . '?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
        }
        if ($video_site == 'youtube') {
            $output .= '<div class="mk-video-wrapper"><div class="mk-video-container"><iframe src="http'.((is_ssl())? 's' : '').'://www.youtube.com/embed/' . $video_id . '?showinfo=0&amp;theme=light&amp;color=white&amp;rel=0" frameborder="0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
        }
        if ($video_site == 'dailymotion') {
            $output .= '<div style="width:' . $image_width . 'px;" class="mk-video-wrapper"><div class="mk-video-container"><iframe src="http'.((is_ssl())? 's' : '').'://www.dailymotion.com/embed/video/' . $video_id . '?logo=0" frameborder="0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
        }
        $output .= '</div>';
    }
    if ($post_type == 'audio') {
        
        $iframe   = get_post_meta($post->ID, '_audio_iframe', true);
        
        if (empty($iframe)) {
            $audio_id = mt_rand(99, 999);
            $mp3_file     = get_post_meta($post->ID, '_mp3_file', true);
            $ogg_file     = get_post_meta($post->ID, '_ogg_file', true);
            $audio_author = get_post_meta($post->ID, '_single_audio_author', true);
            
            $audio_box_color = array(
                '#00c8d7',
                '#e1ba05',
                '#da4c26',
                '#f56a5f',
                '#00b89a',
                '#95c76a',
                '#acacac',
                '#d19760'
            );
            $random_colors   = array_rand($audio_box_color, 1);
            $image_src       = bfi_thumb($image_src_array[0], array(
                'width' => 170,
                'height' => 170
            ));
            $output .= '<div class="mk-audio-section" style="background-color:' . $audio_box_color[$random_colors] . '">';
            if (has_post_thumbnail()) {
                $output .= '<img class="audio-thumb" alt="' . get_the_title() . '" title="' . get_the_title() . '" src="' . $image_src . '" itemprop="image" />';
                $has_image = 'audio-has-img';
            }
            $output .= '<div data-mp3="' . $mp3_file . '" data-ogg="' . $ogg_file . '" id="jquery_jplayer_' . $audio_id . '" class="jp-jplayer mk-blog-audio"></div>
               <div id="jp_container_' . $audio_id . '" class="jp-audio ' . $has_image . '">
                    <div class="jp-type-single">
                         <div class="jp-gui jp-interface">
                              <div class="jp-time-holder">
                                   <div class="jp-current-time"></div>
                                   <div class="jp-duration"></div>
                              </div>

                              <div class="jp-progress">
                                   <div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                   </div>
                              </div>
                              <div class="jp-volume-bar">
                                   <i class="mk-moon-volume-mute"></i><div class="inner-value-adjust"><div class="jp-volume-bar-value"></div></div>
                              </div>
                              <ul class="jp-controls">
                                   <li><a href="javascript:;" class="jp-play" tabindex="1"><i class="mk-icon-play"></i></a></li>
                                   <li><a href="javascript:;" class="jp-pause" tabindex="1"><i class="mk-icon-pause"></i></a></li>
                              </ul>';
            if ($audio_author) {
                $output .= '<span class="mk-audio-author">' . $audio_author . '</span>';
            }
            $output .= '</div>
                         <div class="jp-no-solution">
                              <span>Update Required</span>
                              To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                         </div>
                    </div>
          </div>';
            $output .= '<div class="clearboth"></div></div>';
        } else {
            $output .= '<div class="audio-iframe">' . $iframe . '</div>';
        }
        
    }
    $output .= '<div class="mk-blog-meta">';
    $output .= '<div class="mk-blog-author">' . __('By', 'mk_framework') . ' ';
    ob_start();
    the_author_posts_link();
    $output .= ob_get_contents() . '</div>';
    ob_end_clean();
    $output .= '<span class="mk-categories">' . __('In', 'mk_framework') . ' ' . get_the_category_list(', ') . ' ' . __('Posted', 'mk_framework') . ' </span>';
    
    $output .= '<time datetime="' . get_the_date() . '">';
    $output .= '<a href="' . get_month_link(get_the_time("Y"), get_the_time("m")) . '">' . get_the_date() . '</a>';
    $output .= '</time>';
    
    $output .= '<div class="clearboth"></div>';
    $output .= '<h3 class="the-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    if ($full_content == 'true') {
        $content = str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
        $output .= '<div class="the-excerpt">' . $content . '</div>';
    } else {
        $output .= '<div class="the-excerpt">' . get_the_excerpt() . '</div>';
    }
    if ($disable_comments_share != 'false') {
        if ($mk_options['enable_blog_single_comments'] == 'true'):
            if (get_post_meta($post->ID, '_disable_comments', true) != 'false') {
                ob_start();
                comments_number('0', '1', '%');
                $output .= '<a href="' . get_permalink() . '#comments" class="mk-classic-comments"><i class="mk-moon-bubble-10"></i><span>' . ob_get_contents() . '</span></a>';
                ob_end_clean();
            }
        endif;
        if ($mk_options['single_blog_social'] == 'true'):
            $output .= '<span class="blog-share-container">';
            $output .= '<span class="mk-blog-share mk-toggle-trigger"><i class="mk-moon-share-2"></i></span>';
            $output .= '<ul class="blog-social-share mk-box-to-trigger">';
            $output .= '<li><a class="facebook-share" data-title="' . get_the_title() . '" data-url="' . get_permalink() . '" href="#"><i class="mk-jupiter-icon-simple-facebook"></i></a></li>';
            $output .= '<li><a class="twitter-share" data-title="' . get_the_title() . '" data-url="' . get_permalink() . '" href="#"><i class="mk-jupiter-icon-simple-twitter"></i></a></li>';
            $output .= '<li><a class="googleplus-share" data-title="' . get_the_title() . '" data-url="' . get_permalink() . '" href="#"><i class="mk-jupiter-icon-simple-googleplus"></i></a></li>';
            $output .= '<li><a class="pinterest-share" data-image="' . $image_src_array[0] . '" data-title="' . get_the_title() . '" data-url="' . get_permalink() . '" href="#"><i class="mk-jupiter-icon-simple-pinterest"></i></a></li>';
            $output .= '<li><a class="linkedin-share" data-desc="' . strip_tags(get_the_excerpt()) . '" data-title="' . get_the_title() . '" data-url="' . get_permalink() . '" href="#"><i class="mk-jupiter-icon-simple-linkedin"></i></a></li>';
            $output .= '</ul>';
            $output .= '</span>';
        endif;
    }
    $output .= '<a class="mk-readmore" href="' . get_permalink() . '"><i class="mk-moon-arrow-right-2"></i>' . __('Read More', 'mk_framework') . '</a>';
    $output .= '<div class="clearboth"></div></div>';
    $output .= '</article>' . "\n\n\n";
    return $output;
}
