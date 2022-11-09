<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class Authcontroller extends Controller
{
    protected $user_db = [
        'supervisor' => 'supervisor123',
        'user' => 'user123',
    ];

    public function index()
    {
        return view('auth.login');
    }

    public function loginValidation(Request $request)
    {

        $user = $request->input('user');
        $password = $request->input('password');

        try {
            if ($this->user_db[$user] == $password) {
                if ($this->user_db[$user] == 'supervisor123') {
                    # code...
                    return view('auth.employee', ['super_user' => true, 'user_name' => $user]);
                } else {
                    return view('auth.employee', ['super_user' => false, 'user_name' => $user]);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/');
        }
    }

    public function ajax(Request $request)
    {

        switch ($request->input('action')) {
            case 'default':

                if ($request->input('user') == 'super') {
                    # code...
                    header("X-Sample-Test: foo");
                    header("Content-type: text/plain");
                    return $this->supervisor($request);
                } elseif ($request->input('user') == 'agent') {
                    # code...
                    header("X-Sample-Test: foo");
                    header("Content-type: text/plain");
                    return $this->agents($request);
                }

                break;

            case 'search':
                if ($request->input('user') == 'super') {
                    # code...
                    header("X-Sample-Test: foo");
                    header("Content-type: text/plain");

                    return $this->supervisor($request);
                } elseif ($request->input('user') == 'agent') {
                    # code...
                    header("X-Sample-Test: foo");
                    header("Content-type: text/plain");

                    return $this->agents($request);
                }

                break;

            case 'add_user':
                if ($request->input('user') == 'super') {
                    # code...
                    header("X-Sample-Test: foo");
                    header("Content-type: text/plain");

                    return $this->addUser($request);
                }
                break;

            case 'delete_user':
                if ($request->input('user') == 'super') {
                    # code...
                    header("X-Sample-Test: foo");
                    header("Content-type: text/plain");

                    return $this->deleteUser($request);
                }
                break;
            default:
                # code...
                break;
        }
    }

    public function agents(Request $request)
    {
        $search_filter = $request->input('ser_val');
        $emp = DB::table('d4_employee');
        $tableBody = '';
        if (!empty($search_filter)) {
            $emp->where('emp_name', 'like', "%" . $search_filter . "%");
        }
        $emp = $emp->get();
        if (isset($emp[0])) {
            foreach ($emp as $val) {
                $tableBody .= '<tr>
                <td>' . $val->emp_id . '</td>
                <td>' . $val->emp_name . '</td>
                <td>' . $val->role . '</td>
                <td>' . $val->department . '</td>
                <td>' . $val->created_at . '</td>
                <td>' . $val->updated_at . '</td>
                </tr>';
            }

            return $tableBody;
        } else {
            return 0;
        }
    }

    public function supervisor(Request $request)
    {
        $search_filter = $request->input('ser_val');
        $emp = DB::table('d4_employee');
        if (!empty($search_filter)) {
            $emp->where('emp_name', 'like', "%" . $search_filter . "%");
        }
        $emp = $emp->get();

        $tableBody = '';
        if (isset($emp[0])) {
            foreach ($emp as $val) {
                $tableBody .= '<tr>
                <td>' . $val->emp_id . '</td>
                <td>' . $val->emp_name . '</td>
                <td>' . $val->role . '</td>
                <td>' . $val->department . '</td>
                <td>' . $val->created_at . '</td>
                <td>' . $val->updated_at . '</td>
                <td><button class="btn btn-warning" type="button" onclick="">update</button></td>
                <td><button class="btn btn-warning" type="button" onclick="handleDelete(' . $val->emp_id . ')">delete</button></td>
                </tr>';
            }

            return $tableBody;
        } else {
            return 0;
        }
    }

    public function addUser(Request $request)
    {
        $emp_name = $request->input('emp_val');
        $role = $request->input('role_val');
        $dep = $request->input('dep_val');
        $res = DB::table('d4_employee')->insert(
            ['emp_name' => $emp_name, 'role' => $role, 'department' => $dep]
        );

        return $res;
    }

    public function deleteUser(Request $request)
    {
        $res = DB::table('d4_employee')->where('emp_id', $request->input('emp_id'))->delete();
        return $res;
    }
}
