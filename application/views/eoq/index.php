<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?=$title?></h1>
  <p class="mb-4"></p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold float-right text-primary">Data <?=$title?></h6>
    </div>
    <div class="card-body">
      <?= $this->session->flashdata('message') ?>
      <div class="row">
        <div class="col-md-6">
          <div class="card card-body">
            <table border="0" width="100%">
              <tr>
                <td width="45%" align="center"><img src="<?=base_url('assets/img/XPANDER.jpeg')?>" width="150px"></td>
                <td align="center">
                  <h4><b>MITSUBISHI <br>
                  XPANDER </b></h4><br>
                  <a href="<?=base_url('Eoq/View/XPANDER')?>"><span class="badge badge-primary"><i class="fas fa-search"></i> View</span></a>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-body">
            <table border="0" width="100%">
              <tr>
                <td width="45%" align="center"><img src="<?=base_url('assets/img/OUTLANDER.jpeg')?>" width="200px"></td>
                <td align="center">
                  <h4><b>MITSUBISHI <br>
                  OUTLANDER</b></h4> <br>
                  <a href="<?=base_url('Eoq/View/OUTLANDER')?>"><span class="badge badge-primary"><i class="fas fa-search"></i> View</span></a>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mt-3">
          <div class="card card-body">
            <table border="0" width="100%">
              <tr>
                <td width="45%" align="center"><img src="<?=base_url('assets/img/PAJERO.jpg')?>" width="180px"></td>
                <td align="center">
                  <h4><b>MITSUBISHI <br>
                  PAJERO </b></h4><br>
                  <a href="<?=base_url('Eoq/View/PAJERO')?>"><span class="badge badge-primary"><i class="fas fa-search"></i> View</span></a>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-6 mt-3">
          <div class="card card-body">
            <table border="0" width="100%">
              <tr>
                <td width="35%" align="center"><img src="<?=base_url('assets/img/MIRAGE.jpeg')?>" width="240px"></td>
                <td align="center">
                  <h4><b>MITSUBISHI <br>
                  MIRAGE </b></h4><br>
                  <a href="<?=base_url('Eoq/View/MIRAGE')?>"><span class="badge badge-primary"><i class="fas fa-search"></i> View</span></a>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mt-3">
          <div class="card card-body">
            <table border="0" width="100%">
              <tr>
                <td width="45%" align="center"><img src="<?=base_url('assets/img/STRADA.png')?>" width="150px"></td>
                <td align="center">
                  <h4><b>MITSUBISHI <br>
                  STRADA </b></h4><br>
                  <a href="<?=base_url('Eoq/View/STRADA')?>"><span class="badge badge-primary"><i class="fas fa-search"></i> View</span></a>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-6 mt-3">
          <div class="card card-body">
            <table border="0" width="100%">
              <tr>
                <td width="45%" align="center"><img src="<?=base_url('assets/img/TRITON.jpeg')?>" width="150px"></td>
                <td align="center">
                  <h4><b>MITSUBISHI <br>
                  TRITON </b></h4><br>
                  <a href="<?=base_url('Eoq/View/TRITON')?>"><span class="badge badge-primary"><i class="fas fa-search"></i> View</span></a>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
