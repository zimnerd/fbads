<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MenusTableSeeder extends Seeder
{
    private $menuId = NULL;
    private $dropdownId = [];
    private $dropdown = FALSE;
    private $sequence = 1;
    private $joinData = [];
    private $adminRole = NULL;
    private $userRole = NULL;

    public function join($roles, $menusId)
    {
        $roles = explode(',', $roles);
        foreach ($roles as $role)
        {
            array_push($this->joinData, ['role_name' => $role, 'menus_id' => $menusId]);
        }
    }

    /*
        Function assigns menu elements to roles
        Must by use on end of this seeder
    */
    public function joinAllByTransaction()
    {
        DB::beginTransaction();
        foreach ($this->joinData as $data)
        {
            DB::table('menu_role')->insert([
                'role_name' => $data['role_name'],
                'menus_id' => $data['menus_id'],
            ]);
        }
        DB::commit();
    }

    public function insertLink($roles, $name, $href, $icon = NULL)
    {
        if ($this->dropdown === FALSE)
        {
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'sequence' => $this->sequence
            ]);
        }
        else
        {
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'parent_id' => $this->dropdownId[count($this->dropdownId) - 1],
                'sequence' => $this->sequence
            ]);
        }
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        $permission = Permission::where('name', '=', $name)->get();
        if (empty($permission))
        {
            $permission = Permission::create(['name' => 'visit ' . $name]);
        }
        $roles = explode(',', $roles);
        if (in_array('user', $roles))
        {
            $this->userRole->givePermissionTo($permission);
        }
        if (in_array('admin', $roles))
        {
            $this->adminRole->givePermissionTo($permission);
        }

        return $lastId;
    }

    public function insertTitle($roles, $name)
    {
        DB::table('menus')->insert([
            'slug' => 'title',
            'name' => $name,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence
        ]);
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);

        return $lastId;
    }

    public function beginDropdown($roles, $name, $icon = '')
    {
        if (count($this->dropdownId))
        {
            $parentId = $this->dropdownId[count($this->dropdownId) - 1];
        }
        else
        {
            $parentId = NULL;
        }
        DB::table('menus')->insert([
            'slug' => 'dropdown',
            'name' => $name,
            'icon' => $icon,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence,
            'parent_id' => $parentId
        ]);
        $lastId = DB::getPdo()->lastInsertId();
        array_push($this->dropdownId, $lastId);
        $this->dropdown = TRUE;
        $this->sequence++;
        $this->join($roles, $lastId);

        return $lastId;
    }

    public function endDropdown()
    {
        $this->dropdown = FALSE;
        array_pop($this->dropdownId);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Get roles */
        $this->adminRole = Role::where('name', '=', 'admin')->first();
        $this->userRole = Role::where('name', '=', 'user')->first();
        /* Create Sidebar menu */
        DB::table('menulist')->insert([
            'name' => 'sidebar menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $this->insertLink('user,admin', 'Dashboard', '/dashboard', 'cil-speedometer');
        $this->insertLink('guest', 'Login', '/login', 'cil-account-logout');
        $this->insertLink('guest', 'Register', '/register', 'cil-account-logout');
        $this->insertLink('user,admin', 'Campaigns', '/campaigns', 'cil-apps');
        $this->insertLink('admin', 'Users', '/users','cil-people');
        $this->beginDropdown('admin', 'Settings','cil-puzzle');
        $this->insertLink('admin', 'Edit menu', '/menu/menu');
        $this->insertLink('admin', 'Edit menu elements', '/menu/element');
        $this->insertLink('admin', 'Edit roles', '/roles');
        $this->endDropdown();


        /* Create top menu */
        DB::table('menulist')->insert([
            'name' => 'top menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $id = $this->insertLink('guest,user,admin', 'Dashboard', '/');
        $id = $this->insertLink('user,admin', 'Campaigns', '/campaigns');
        $id = $this->insertLink('admin', 'Users', '/users');
        $id = $this->beginDropdown('admin', 'Settings');
        $id = $this->insertLink('admin', 'Edit menu', '/menu/menu');
        $id = $this->insertLink('admin', 'Edit menu elements', '/menu/element');
        $id = $this->insertLink('admin', 'Edit roles', '/roles');
        $this->endDropdown();
        $id = $this->insertLink('guest', 'Login', '/login');
        $id = $this->insertLink('guest', 'Register', '/register');
        $this->joinAllByTransaction(); ///   <===== Must by use on end of this seeder
    }
}
