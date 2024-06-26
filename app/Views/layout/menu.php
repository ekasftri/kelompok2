<?= $this->extend('Layout/main') ?>
<?= $this->section('menu') ?>
<li class="has-menu">
    <a href="<?= site_url('Layout/index') ?>"><i class="mdi mdi-airplay"></i>Beranda</a>

</li>
<li class="has-menu">
<a href="<?= site_url('Barang/index') ?>"><i class="mdi mdi-airplay"></i>Barang</a>
</li>
<?= $this->endSection() ?>