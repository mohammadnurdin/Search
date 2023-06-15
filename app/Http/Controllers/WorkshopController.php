<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\User;
use App\Models\Detail;
use Illuminate\Http\Request;
use App\Charts\WorkshopLineChart;

// use Monolog\Handler\IFTTTHandler;
// use PgSql\Result;

class WorkshopController extends Controller
{
    public function index()
    {   
        $title = "Data Workshop";
        $workshops = Workshop::orderBy('id','asc')->get();
        return view('workshops.index', compact(['workshops' , 'title']));
    }

    public function create()
    {
        $title = "Tambah Data Workshop";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        return view('workshops.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_workshop' => 'required'
        ]);

        $workshop = [
            'id_workshop' => $request->id_workshop,
            'nama_workshop' => $request->nama_workshop,
            'bulan' => $request->bulan,
            'ketua' => $request->ketua,
        ];
        // // for ($i=1; $i <= 2; $i++) {
        // //     $details = [

        // //     ];
        // // }
        // // dd($request);
        
        // Workshop::create($request->post());

        if($result = Workshop::create($workshop)){
            for ($i=1; $i <= $request->jml; $i++){
                $details = [
                    'id_workshop' => $request->id_workshop,
                    'id_kegiatan' => $request['id_kegiatan'.$i],
                    'peserta' => $request['peserta'.$i],
                    'keterangan' => $request['keterangan'.$i]
                
                ];
                Detail::create($details);
            }
        }

        return redirect()->route('workshops.index')->with('success','Workshops has been created successfully.');
    }

    public function show(Workshop $workshop)
    {
        return view('workshops.show',compact('Departement'));
    }

    public function edit(Workshop $workshop)
    {
        $title = "Edit Data workshop";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        $detail = Detail::where('id_workshop', $workshop->id_workshop)->orderBy('id', 'asc')->get();
        return view('workshops.edit',compact('workshop' , 'title', 'managers', 'detail'));
    }

    public function update(Request $request, Workshop $workshop)
    {
        $workshops = [
            'id_workshop' => $workshop->id_workshop,
            'nama_workshop' => $request->nama_workshop,
            'bulan' => $request->bulan,
            'ketua' => $request->ketua,
            // 'total' => $request->total,
        ];
        if ($workshop->fill($workshops)->save()){
            Detail::where('id_workshop', $workshop->id_workshop)->delete();
            for ($i=1; $i <= $request->jml; $i++) { 
                $details = [
                    'id_workshop' => $workshop->id_workshop,
                    'id_kegiatan' => $request['id_kegiatan'.$i],
                    'acara' => $request['acara'.$i],
                    'tempat' => $request['tempat'.$i],
                    'pelaksana' => $request['ketua'.$i],
                    'peserta' => $request['peserta'.$i],
                    'keterangan' => $request['keterangan'.$i],
                ];
                Detail::create($details);
            }
        }
        return redirect()->route('workshops.index')->with('success','Workshop Has Been updated successfully');
    }

    public function destroy(Workshop $workshop)
    {
        $workshop->delete();
        return redirect()->route('workshops.index')->with('success','Workshop has been deleted successfully');
    }

    public function exportPdf()
    {
        $title = "Laporan Data Workshop";
        $workshops = Workshop::orderBy('id', 'asc')->get();

        $pdf = PDF::loadview('workshops.pdf', compact(['workshops', 'title']));
        return $pdf->stream('laporan-workshops-pdf');
    }

    public function chartLine()
    {
        $api = url(route('workshops.chartLineAjax'));
   
        $chart = new WorkshopLineChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($api);
        $title = "Chart Ajax";
        return view('home', compact('chart','title'));
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function chartLineAjax(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y');
        $workshops = Workshop::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('tanggal', $year)
                    ->groupBy(\DB::raw("Month(tanggal)"))
                    ->pluck('count');
  
        $chart = new WorkshopLineChart;
  
        $chart->dataset('Workshop Register Chart', 'line', $workshops)->options([
                    'fill' => 'true',
                    'borderColor' => '#51C1C0'
                ]);
  
        return $chart->api();
    }

}
