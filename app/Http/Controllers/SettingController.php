<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

/**
 * Class SettingController
 * @package App\Http\Controllers
 */
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=1;
        $setting = Setting::find($id);      
        if($setting==1){
        return view('setting.edit', compact('setting'));
        } else {
            $setting = new Setting();
            return view('setting.create', compact('setting'));
        }
        
    }

    public function create()
    {
        $setting = new Setting();
        return view('setting.create', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  /*  public function create()
    {
        $setting = new Setting();
        return view('setting.create', compact('setting'));
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Setting::$rules);

        return redirect()->route('settings.index')
            ->with('success', 'Configuración de empresa creada con exito.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        request()->validate(Setting::$rules);

        $setting->update($request->all());

        return redirect()->route('settings.edit')
            ->with('success', 'Setting updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $setting = Setting::find($id)->delete();

        return redirect()->route('settings.index')
            ->with('success', 'Setting deleted successfully');
    }
}
