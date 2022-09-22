<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomSetup;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class FormRequestController extends Controller
{
    public function getCreateModalData($data)
    {
        switch ($data) {
            case 'new_user':
                return view('forms.input-forms.user_form');
                break;

            case 'user_profile':
                return view('forms.input-forms.user_profile');
                break;

            case 'new_custom':
                return view('forms.input-forms.custom_type_form');
                break;

            case 'new_staff':
                return view('forms.input-forms.staff_form');
                break;

            case 'new_customer':
                return view('forms.input-forms.customer_form');
                break;

            default:
                return "No Form Selected";
                break;
        }
    }

   public function getEditModalData($data, $id)
   {
        switch ($data) {
            case 'edit_user':
                $user = User::find($id);
                return view('forms.input-forms.user_form', ['user' => $user]);
                break;

            case 'edit_custom':
                $custom = CustomSetup::find($id);
                return view('forms.input-forms.custom_type_form', ['custom' => $custom]);
                break;

            case 'edit_staff':
                $staff = Staff::find($id);
                return view('forms.input-forms.staff_form', ['staff' => $staff]);
                break;

            case 'edit_customer':
                $customer = Customer::find($id);
                return view('forms.input-forms.customer_form', ['customer' => $customer]);
                break;
        
            default:
                return "No Form Selected";
                break;
        }
   }
   
   
   public function getViewModalData($data, $id)
   {
        switch ($data) {
            case 'delete_user':
                $user = User::find($id);
                return view('forms.view-forms.gallery_view', ['user' => $user]);
                break;
        
            default:
                return "No Form Selected";
                break;
        }
    }

    public function getDeleteModalData($data, $id)
    {
        switch ($data) {
            case 'delete_user':
                return view('forms.delete-forms.delete_user', ['id' => $id]);
                break;

            case 'delete_custom':
                return view('forms.delete-forms.delete_custom', ['id' => $id]);
                break;

            case 'delete_staff':
                return view('forms.delete-forms.delete_staff', ['id' => $id]);
                break;

            case 'delete_customer':
                return view('forms.delete-forms.delete_customer', ['id' => $id]);
                break;
        
            default:
                return "No Form Selected";
                break;
        }
    }
}
