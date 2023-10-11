<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('/articles')?>">Articles</a>
                        </li>
                        <li class="breadcrumb-item">
                            Tags
                        </li>
                        <li class="breadcrumb-item active">
                            <?= ucfirst(str_replace('-', ' ',$this->uri->segment(3))) ?>
                        </li>
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

            <?php if( count($result) ){ ?>
              
                <div class="row flex-row blog">
                    <?php foreach ($result as $value): ?>
                        
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 pl-2 pr-2">
                        <div class="card box-shadow mb-4 move-up-hover">
                            <img src="<?= base_url('storage/300/' . $value->images)?>" class="card-img-top article-thumbnail">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><?= $value->categorys_name?></h5>
                                <p class="card-text">
                                <a href="<?= base_url('/articles/' . $value->slug_c . '/' . $value->slug_a . '')?>"><?= $value->title ?></a>
                                </p>
                            </div>
                            <div class="card-footer">
                                <i class="fas fa-user-circle text-primary"></i>
                                <span>
                                    <a href="<?= base_url('/author/'.$value->slug_u.'')?>"><?= $value->name ?></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>

                <nav class="mt-5 mb-5 pagination justify-content-center"><?= $pagination ?></nav>
          
            <?php }else { ?>
                
            <div class="text-center mt-5 mb-5">
                <div class="error_404 error mx-auto" data-text="404">404</div>
                <p class="lead text-gray-800 mb-5">Oppss ! Sepertinya yang kamu cari tidak di temukan.</p>
            </div>
            
            <?php } ?>

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