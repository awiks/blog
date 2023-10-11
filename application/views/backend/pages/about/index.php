<div class="card shadow mb-4">
    <div class="card-header py-2">
        <h6 class="m-0 font-weight-bold text-primary py-2 float-left">Data About</h6>

        <a href="<?= base_url('cpanel/pages/about/create')?>" 
           class="btn bg-maroon btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-plus-circle"></i>
            </span>
            <span class="text">Add data</span>
        </a>

    </div>
    <div class="card-body">

    <?php if (count($about) > 0): ?>
        <?php foreach ($about as $item): ?>
        <div class="row mb-3">
            <div class="col-md-5 pr-0">
                <img src="<?= base_url('storage/'.$item->images.'') ?>" 
                     class="img img-fluid profile">
                <div class="ribbon-wrapper">
                    <?php if($item->status==0): ?>
                    <div class="ribbon bg-danger">
                      Pending
                    </div>
                    <?php else: ?>
                    <div class="ribbon bg-success">
                      Publish
                    </div>
                    <?php endif; ?>
                  </div>
            </div>
            <div class="col-md-7">
                <div class="post pl-2">
                    <h3><?= $item->title ?></h3>
                    <h5><?= date('d F Y',strtotime($item->created_at)) ?></h5>
                    <p><?= $item->content ?></p>
                
                <div class="btn-group">
                    <a href="<?= base_url('/cpanel/pages/about/edit/'.$item->slug.'') ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                    <a href="#Modal-del" data-toggle="modal" id="<?= $item->id ?>" class="btn btn-outline-secondary btn-sm delete">Delete</a>
                </div>

                </div>
            </div>
        </div>
        
        <?php endforeach; ?>

        
    <?php else: ?>
        <h5>Data masih kosong</h5>
    <?php endif; ?>
        
        
    </div>
</div>