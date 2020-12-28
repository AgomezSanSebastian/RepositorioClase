<!-- Page Content -->

<div class="container mb-5">
    <div class="row mt-5">

        <div class="col-lg-3"></div>

        <div class="col-lg-6 form_login">
            <form class="form-signin" method="POST" action="actions/loginAct.php">
                <div class="form-group row">
                    <label for="display_name" class="col-lg-4 col-form-label">Nombre usuario: </label>
                    <div class="col-lg-7 text-left">
                        <input type="text" class="form-control" id="display_name" name="display_name" placeholder="" />
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="password" class="col-lg-4 col-form-label text-center">Password: </label>
                    <div class="col-lg-7 text-left">
                        <input type="password" class="form-control" id="password" name="password" placeholder="" />
                    </div>
                </div>
                <div class="row mt-5">
                    <label class="col-lg-5"></label>
                    <a class=" btn btn-secondary btn-lg" href="index.php?page=registro">Ingresar </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.container -->