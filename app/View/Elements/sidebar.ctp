<div class="page-sidebar navbar-collapse collapse">
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="start active ">
					<a href="#">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					</a>
				</li>
				<?php if($roles=='admin') { ?>
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Manage Categories">
					<a href="<?= SITE_URL;?>admins/categories">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Categories</span>
					</a>
				</li>
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Manage Families">
					<a href="<?= SITE_URL;?>admins/families">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Families</span>
					</a>
				</li>
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="">
					<a href="<?= SITE_URL;?>admins/typeOfFormat">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Type Of Format </span>
					</a>
				</li>
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="">
					<a href="<?= SITE_URL;?>admins/typeOfBusiness">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Type Of Business </span>
					</a>
				</li>
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Import/Export">
					<a href="<?= SITE_URL;?>admins/impexp_families">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Import/Export Families</span>
					</a>
				</li>
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Import/Export">
					<a href="<?= SITE_URL;?>admins/impexp_categories">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Import/Export Categories</span>
					</a>
				</li>
				<?php } ?>
				<?php if($roles=='customer') { ?>
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Add demands">
					<a href="<?= SITE_URL;?>customers/choose_category">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Crear listas</span>
					</a>
				</li>
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Share lists">
					<a href="<?= SITE_URL;?>customers/all_demands">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Compartir listas</span>
					</a>
				</li>
				
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Check offers">
					<a href="<?= SITE_URL;?>customers/view_offers">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Revisar ofertas</span>
					</a>
				</li>
				<?php } ?>
				<?php if($roles=='wholesaler') { ?>
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Create Your Lists">
					<a href="<?= SITE_URL;?>wholesalers/create_your_lists">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Crear Listas </span>
					</a>
				</li>
				<!--li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Crea tus listas">
					<a href="<?= SITE_URL;?>wholesalers/wholesaler_list">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Wholesaler Lists </span>
					</a>
				</li-->
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Import/Export">
					<a href="<?= SITE_URL;?>wholesalers/impexp_wholesalerlists">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Importar CSV con ofertas</span>
					</a>
				</li>
				<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Realiza ofertas">
					<a href="<?= SITE_URL;?>wholesalers/make_offers">
					<i class="icon-paper-plane"></i>
					<span class="title">
					Realizar ofertas</span>
					</a>
				</li>
				
				<?php } ?>
				<!--li class="last ">
					<a href="javascript:;">
					<i class="icon-pointer"></i>
					<span class="title">Maps</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="maps_google.html">
							Google Maps</a>
						</li>
						<li>
							<a href="maps_vector.html">
							Vector Maps</a>
						</li>
					</ul>
				</li-->
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>