<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?php echo base_url(); ?>admin" class="<?php echo $this->uri->segment(2) == '' ? 'active': '' ?>"><i class="lnr lnr-enter"></i> <span>Home</span></a></li>
				<li><a href="<?php echo base_url(); ?>admin/blankoktp" class="<?php echo $this->uri->segment(2) == 'blankoktp' ? 'active': '' ?>"><i class="lnr lnr-enter"></i> <span>Blanko KTP</span></a></li>
				<li><a href="<?php echo base_url(); ?>admin/blankokia" class="<?php echo $this->uri->segment(2) == 'blankokia' ? 'active': '' ?>"><i class="lnr lnr-enter"></i> <span>Blanko KIA</span></a></li>
				<li><a href="<?php echo base_url(); ?>admin/pengajuan" class="<?php echo $this->uri->segment(2) == 'pengajuan' ? 'active': '' ?>"><i class="lnr lnr-enter"></i> <span>Pengajuan</span></a></li>
				<li><a href="<?php echo base_url(); ?>admin/pengguna" class="<?php echo $this->uri->segment(2) == 'pengguna' ? 'active': '' ?>"><i class="lnr lnr-enter"></i> <span>Pengguna</span></a></li>
			</ul>
		</nav>
	</div>
</div>
	