<div class="card shadow mb-4">
    <div class="card-header py-2">
        <h6 class="m-0 font-weight-bold text-primary py-2 float-left">Data Profile</h6>

        <a href="<?= base_url('cpanel/profile/create')?>" 
           class="btn bg-maroon btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-plus-circle"></i>
            </span>
            <span class="text">Add data</span>
        </a>

    </div>
    <div class="card-body">

    <?php if (count($profile) > 0): ?>
        <?php foreach ($profile as $item): ?>
        <div class="row mb-3">
            <div class="col-md-5 pr-0">
                <img src="<?= base_url('storage/'.$item->image.'') ?>" 
                     class="img img-fluid profile">
            </div>
            <div class="col-md-7">
                <div class="post pl-2">
                    <h3><?= $item->name ?></h3>
                    <h5><?= date('d F Y',strtotime($item->created_at)) ?></h5>
                    <p><?= $item->about ?></p>
                
                <div class="btn-group">
                    <a href="<?= base_url('/cpanel/profile/edit/'.$item->slug.'') ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
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