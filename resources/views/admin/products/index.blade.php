<x-admin-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-10 px-4 sm:px-0">
                <h2 class="text-3xl font-black text-gray-900 tracking-tighter italic uppercase">
                    Eğitim <span class="text-blue-600">Envanteri</span>
                </h2>
                <a href="{{ route('admin.products.create') }}" 
                   class="bg-blue-600 text-white px-8 py-3 rounded-2xl font-black shadow-xl hover:bg-gray-900 transition-all uppercase text-[10px] tracking-widest">
                    Yeni Paket Ekle
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100 mx-4 sm:mx-0">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-900">
                        <tr>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Görsel & ID</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Ürün Detayı</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Finansal</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Kontenjan</th>
                            <th class="px-8 py-5 text-right text-[10px] font-bold text-gray-400 uppercase tracking-widest">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($products as $product)
                        <tr class="hover:bg-blue-50/30 transition-all group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 w-14 h-14 relative">
                                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('storage/products/default.webp') }}" 
                                             class="w-full h-full rounded-2xl object-cover shadow-lg border-2 border-white ring-1 ring-gray-100" 
                                             alt="{{ $product->title }}">
                                    </div>
                                    <span class="text-[10px] font-black text-gray-300 uppercase italic">#{{ $product->id }}</span>
                                </div>
                            </td>

                            <td class="px-8 py-6">
                                <div class="text-sm font-black text-gray-900 uppercase italic leading-none mb-1 group-hover:text-blue-600 transition-colors">
                                    {{ $product->title }}
                                </div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase italic tracking-tighter">
                                    {{ Str::limit($product->description, 45) }}
                                </div>
                            </td>

                            <td class="px-8 py-6 whitespace-nowrap">
                                <span class="text-sm font-black text-gray-900 italic">
                                    {{ number_format($product->price, 2) }} <span class="text-blue-600 text-[10px]">TL</span>
                                </span>
                            </td>

                            <td class="px-8 py-6">
                                <span class="px-4 py-1.5 {{ $product->stock < 5 ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600' }} rounded-xl text-[9px] font-black uppercase tracking-widest">
                                    {{ $product->stock }} {{ __('Kontenjan') }}
                                </span>
                            </td>

                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end items-center gap-3">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                       class="text-[10px] font-black uppercase text-gray-400 hover:text-blue-600 transition-all tracking-widest underline decoration-2 underline-offset-4">
                                        Düzenle
                                    </a>
                                    
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Bu eğitimi sistemden tamamen kaldırmak istediğinize emin misiniz?')"
                                                class="bg-red-50 text-red-600 p-2 rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <p class="mt-6 text-center text-[9px] text-gray-400 font-bold uppercase tracking-[0.2em]">
                Global Vizyon V3.0 — Envanter Yönetim Paneli
            </p>
        </div>
    </div>
</x-admin-layout>