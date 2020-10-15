            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                            <div class="nav">
                                <?php

                                $userRoleId = $this->session->userdata('user_role_id');

                                $queryMenu = "SELECT a.id, a.menu
                                    FROM x_user_menu a INNER JOIN x_user_access_menu b
                                    ON a.id = b.menu_id
                                    WHERE b.user_role_id = $userRoleId
                                    ORDER BY b.menu_id";

                                $menus = $this->db->query($queryMenu)->result_array();

                                ?>

                                <?php foreach ($menus as $menu) : ?>

                                    <div class="sb-sidenav-menu-heading"><?= $menu['menu'] ?></div>

                                    <?php

                                    $menuId = $menu['id'];

                                    $querySubmenu = "SELECT * 
                                                        FROM x_user_submenu
                                                        WHERE menu_id = $menuId
                                                        AND is_active = 1";

                                    $submenus = $this->db->query($querySubmenu)->result_array();

                                    foreach ($submenus as $submenu) :

                                        if ($submenu['is_parent'] == 1) { ?>

                                            <?php
                                            $submenu_id = $submenu['id'];

                                            $queryListsubmenu = "SELECT *
                                                                    FROM x_user_listmenu
                                                                    WHERE submenu_id = $submenu_id
                                                                    AND is_active = 1;";

                                            $listSubMenus = $this->db->query($queryListsubmenu)->result_array();
                                            ?>

                                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#<?= $submenu['data_target']; ?>" aria-expanded="false" aria-controls="<?= $submenu['data_target']; ?>">
                                                <div class="sb-nav-link-icon"><i class="<?= $submenu['icon'] ?>"></i></div>
                                                <?= $submenu['title'] ?>
                                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                            </a>

                                            <div class="collapse" id="<?= $submenu['data_target'] ?>" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                                <nav class="sb-sidenav-menu-nested nav">
                                                    <?php foreach ($listSubMenus as $listSubMenu) : ?>
                                                        <a class="nav-link" href="<?= base_url();
                                                                                    echo $listSubMenu['url'] ?>">
                                                            <?= $listSubMenu['title'] ?>
                                                            <a>
                                                            <?php endforeach; ?>
                                                </nav>
                                            </div>
                                        <?php } else { ?>
                                            <a class="nav-link" href="<?= base_url();
                                                                        echo $submenu['url']; ?>">
                                                <div class="sb-nav-link-icon"><i class="<?= $submenu['icon']; ?>"></i></div>
                                                <?= $submenu['title'] ?>
                                            </a>
                                <?php }
                                    endforeach;
                                endforeach; ?>
                            </div>
                        </div>
                        <div class="sb-sidenav-footer">
                            <div class="small">Logged in as:</div>
                            <?= $_SESSION['name'] ?>
                        </div>
                    </nav>
                </div>