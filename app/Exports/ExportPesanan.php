<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Pesanan;

class ExportPesanan implements FromView, ShouldAutoSize, WithEvents {
    protected $request;
	public function __construct($request) {
		$this->request = $request;
	}

    
    public function registerEvents(): array {
		return [
			AfterSheet::class => function(AfterSheet $event) {
				$baris_1 = 'A1:J1';
				$event->sheet->getDelegate()->getStyle($baris_1)->getFont()->setSize(14);
				$event->sheet->getDelegate()->getStyle($baris_1)->getAlignment()->setHorizontal("center");
				$event->sheet->getDelegate()->getStyle($baris_1)->getAlignment()->setVertical("center");
				$event->sheet->getStyle($baris_1)->applyFromArray([
					'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '69b3ff',
                         ]           
                    ],
                    'borders' => [
						'allBorders' => [
							'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
							'color' => ['argb' => '333333'],
						],
					],
				]);
			},
		];

	}

    public function view(): View {
        $status = $this->request->status;

        $result = Pesanan::select('pesanans.*','kategoris.kategori','kategoris.harga')
        ->join('kategoris','kategoris.id','pesanans.kategori_id');

        if(!empty($status)) {
            $result = $result->where('status', $status);
        }

        $result = $result->get()
        ->map(function($item) {
            return [
                'nm_lengkap'    => $item->nm_lengkap,
                'email'         => $item->email,
                'no_hp'         => $item->no_hp,
                'alamat'        => $item->alamat,
                'tiket_id'      => $item->tiket_id,
                'tgl_pesan'     => $item->created_at,
                'kategori'      => $item->kategori,
                'harga'         => $item->harga,
                'status'        => $item->status==0?"Belum Check IN":"Check IN",
            ];
        });

		return view('admin.pages.pesanan.excel', compact('result'));
	}
}
