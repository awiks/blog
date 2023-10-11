<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?=base_url('/')?>"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Articles</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="blog-content-area mb-5 pb-5">
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <h1 class="mb-3"><?= $title ?></h1>
            <div class="text-muted">
                <p>
                    <span class="mr-3">
                        <i class="fas fa-calendar"></i> <?= date('F d,Y',strtotime($created_at)) ?>
                    </span>

                    <span class="mr-3">
                        <i class="fas fa-user"></i> <?= $author ?>
                    </span>

                    <span class="mr-3">
                        <i class="fas fa-comment"></i> <?= count($comments) ?>
                    </span>
                </p>
            </div>

            <img src="<?= base_url('storage/900/' . $images)?>" class="article-cover br3">

            <p><?= $contents ?></p>

            <p>Tags : 
                <?php foreach ( $tags as $key=>$tag): ?>

                <a href="<?= base_url('/articles/tags/'.$tag->slug.'')?>"
                    class="badge badge-warning p-2 badge-pill">
                      <span>#<?= $tag->tags_name ?></span>
                </a>
                
                <?php endforeach ?> 
            </p>

            <aside class="mb-4 mt-3">
                <p class="gray mb-1"> Share:</p>
                <div class="flex flex-row items-center">
                    <button label="Facebook"
                            onclick="window.open(`https://web.facebook.com/sharer/sharer.php?kid_directed_site=0&u=${window.location.href}&display=popup`, 'Share Facebook', 'width=500,height=350')"  
                            class="btn bg-transparent pa0" 
                            title="facebook" target="_blank">
                            <svg height="42px" version="1.1" viewBox="0 0 67 67" width="42px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M28.765,50.32h6.744V33.998h4.499l0.596-5.624h-5.095  l0.007-2.816c0-1.466,0.14-2.253,2.244-2.253h2.812V17.68h-4.5c-5.405,0-7.307,2.729-7.307,7.317v3.377h-3.369v5.625h3.369V50.32z   M33,64C16.432,64,3,50.569,3,34S16.432,4,33,4s30,13.431,30,30S49.568,64,33,64z" fill="#3b5998"></path></svg>
                    </button>
                    <a href="https://wa.me/?text=<?= $title.''.base_url('articles/'.$slug_c.'/'.$slug_a.'')?>"  
                       class="btn bg-transparent pa0"  
                       title="Whatsapp" 
                       target="_blank">
                       <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="48px" height="48px"><path fill="#fff" d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z"/><path fill="#fff" d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z"/><path fill="#cfd8dc" d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z"/><path fill="#40c351" d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z"/><path fill="#fff" fill-rule="evenodd" d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z" clip-rule="evenodd"/></svg>
                    </a>
                    </a>
                    <a href="https://t.me/share/url?url=<?= base_url('articles/'.$slug_c.'/'.$slug_a.'')?>" 
                       class="btn bg-transparent pa0" 
                       title="Telegram" 
                       target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="45px" height="45px"><path fill="#29b6f6" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z"/><path fill="#fff" d="M33.95,15l-3.746,19.126c0,0-0.161,0.874-1.245,0.874c-0.576,0-0.873-0.274-0.873-0.274l-8.114-6.733 l-3.97-2.001l-5.095-1.355c0,0-0.907-0.262-0.907-1.012c0-0.625,0.933-0.923,0.933-0.923l21.316-8.468 c-0.001-0.001,0.651-0.235,1.126-0.234C33.667,14,34,14.125,34,14.5C34,14.75,33.95,15,33.95,15z"/><path fill="#b0bec5" d="M23,30.505l-3.426,3.374c0,0-0.149,0.115-0.348,0.12c-0.069,0.002-0.143-0.009-0.219-0.043 l0.964-5.965L23,30.505z"/><path fill="#cfd8dc" d="M29.897,18.196c-0.169-0.22-0.481-0.26-0.701-0.093L16,26c0,0,2.106,5.892,2.427,6.912 c0.322,1.021,0.58,1.045,0.58,1.045l0.964-5.965l9.832-9.096C30.023,18.729,30.064,18.416,29.897,18.196z"/></svg>
                    </a>
                </div>
            </aside>

            <div class="comment_area clearfix">
                <h4 class="headline"><?= count($total_comments) ?> Komentar</h4>                                   
                <ol>
                    <?php 
                    foreach ($comments as $row): 
                     $query = $this->db->query("SELECT * FROM comments 
                                                WHERE parent_id='$row->id'");
                     $child = $query->result();
                    ?>
                    <!-- Single Comment Area -->
                    <li class="single_comment_area">
                        <div class="comment-wrapper d-flex">
                            <!-- Comment Meta -->
                            <div class="comment-author">
                                <img src="<?= base_url('asset/public/img/user.png')?>" alt="">
                            </div>
                            <!-- Comment Content -->
                            <div class="comment-content">
                                <span class="comment-date"><?= date('d F Y',strtotime($row->created_at)) ?></span>
                                <h5><?= $row->name ?></h5>
                                <p><?= $row->comment ?></p>
                                <a href="#" data-comments="<?= $row->id ?>" id="replay">Balas</a>
                            </div>
                        </div>
                        <ol class="children">
                            <?php foreach ($child  as $val): ?>
                            <li class="single_comment_area">
                                <div class="comment-wrapper d-flex">
                                    <!-- Comment Meta -->
                                    <div class="comment-author">
                                        <img src="<?= base_url('asset/public/img/user.png')?>">
                                    </div>
                                    <!-- Comment Content -->
                                    <div class="comment-content">
                                        <span class="comment-date"><?= date('d F Y',strtotime($val->created_at))?></span>
                                        <h5><?= $val->name ?></h5>
                                        <p><?= $val->comment ?></p>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach ?>
                        </ol>
                    </li>
                    <?php endforeach ?>
                </ol>
            </div>

            <div class="my-5">
            <form id="simpan" action="<?= base_url('articles/comments') ?>" method="post">
                <input type="hidden" name="parent_id" id="parent_id">
                <input type="hidden" name="article_id" value="<?= $article_id ?>">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" maxlength="50" class="form-control" id="contact-name" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <input type="email" name="email" maxlength="100" class="form-control" id="contact-email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control" maxlength="150" name="comment" id="comment" cols="30" rows="5" placeholder="Comment" required></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-secondary">Send Message</button>
                    </div>
                </div>
            </form>
            </div>

          </div>
          <div class="col-lg-4">
            <div class="post-sidebar-area">

                <div class="single-widget-area mb-30">
                    <div class="widget-title">
                        <h6>Categories</h6>
                    </div>
                    <ol class="catagories">
                        <?php foreach ($category as $item): 
                            $query = $this->db->query("SELECT count(*) as jml FROM articles
                                                       WHERE category_id='$item->id'");
                            $rows = $query->row();
                        ?>
                        <li>
                            <a href="<?= base_url('/articles/category/' . $item->slug . '') ?>">
                                <span>
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i> 
                                    <?= $item->categorys_name ?>
                                </span> 
                                <span class="pr-2">(<?= $rows->jml ?>)</span>
                            </a>
                        </li>
                        <?php endforeach ?>
                    </ol>
                </div>

                <div class="single-widget-area mb-30">
                    <div class="widget-title mb-3">
                        <h6>LATEST POSTS</h6>
                    </div>
                    <?php foreach ($lates as $item): ?>
                     
                    <div class="single-latest-post d-flex">
                        <div class="post-thumb">
                            <img src="<?= base_url('storage/300/'.$item->images) ?>">
                        </div>
                        <div class="post-content">
                            <a href="<?= base_url('/articles/' . $item->slug_c . '/' . $item->slug_a . '')?>" class="post-title">
                                <h6><?= $item->title ?></h6>
                            </a>
                            <a href="<?= base_url('/author/'.$item->slug_u.'')?>" class="post-author"><span>by</span>
                                <?= $item->name ?>
                            </a>
                        </div>
                    </div>

                    <?php endforeach ?>
                    
                </div>


                <div class="single-widget-area mb-30">
                    <div class="widget-title mb-3">
                        <h6>popular tags</h6>
                    </div>
                    <ol class="popular-tags d-flex flex-wrap">
                        <?php foreach ($tag_detail as $item): ?>
                        <li><a href="<?= base_url('/articles/tags/'.$item->slug)?>"><?= $item->tags_name ?></a></li>
                        <?php endforeach ?>

                        
                    </ol>
                </div>

            </div>
          </div>
        </div>
    </div>
</section>