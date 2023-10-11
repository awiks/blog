<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Author</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="mb-5 pb-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6">
                <img src="<?= base_url('storage/'.$profile->image) ?>" 
                     class="img img-fluid profile">
            </div>
            <div class="col-md-6">
                <h1><?= $profile->name ?></h1>
                <p class="text-justify"><?= $profile->about ?></p>
            </div>
        </div>
    </div>
</section>
