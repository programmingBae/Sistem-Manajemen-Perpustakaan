<?php
function cekLogin()
{
    //dalam helper tidak bisa menggunakan $this. jadi menggunakan function get_instance(); untuk menggantikan $this
    $ci = get_instance();
    //untuk mengecek sudah login atau belum
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');

        //mengambil segment yang ada di url
        //contoh example.com/index.php(dalam kondisi yang sekarang tidak pake ini)/news/local/metro/crime_is_up
        //segment bakal jadi kaya:
        //segment 1. news
        //------- 2. local
        //------- 3. metro
        //------- 4. crime_is_up

        $menu = $ci->uri->segment(1);

        //select * from user_menu where 'user_menu' = $menu 
        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];
        //select * from user_access_menu where 'role_id' = $role_id , 'menu_id' = $menu_id
        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}


function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $result = $ci->db->get_where('user_access_menu', [
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ]);
    if ($result->num_rows() > 0) {
        return 'checked="checked"';
    }
}
