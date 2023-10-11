<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('/')?>"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Portofolio</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="section-padding-100">
    <div class="container">
       
       <?php  foreach ($result as $key => $item ): ?>

        <div class="row mb-5">
            <?php if ($key % 2 == 0){ ?>
            <div class="col-md-6">
                <img src="<?= base_url('storage/'.$item->images) ?>" 
                     class="img img-fluid article-thumbnail">
            </div>
            <div class="col-md-6">
                <h1><?= $item->title ?></h1>
                <p><?= $item->content ?></p>
            </div>
           <?php } else { ?>
            <div class="col-md-6">
                <h1><?= $item->title ?></h1>
                <p><?= $item->content ?></p>
            </div>
            <div class="col-md-6">
                <img src="<?= base_url('storage/'.$item->images) ?>" 
                     class="img img-fluid article-thumbnail">
            </div>
           <?php } ?>
        </div>
       <?php endforeach ?>
    </div>
</section>