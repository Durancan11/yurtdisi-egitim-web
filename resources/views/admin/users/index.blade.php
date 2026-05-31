<x-admin-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black text-gray-900 mb-10 tracking-tighter italic uppercase">Üye <span class="text-blue-600">Yönetim Merkezi</span></h2>
            
            <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-gray-100">
                <table class="w-full text-left">
                    <thead class="bg-gray-900">
                        <tr>
                            <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Öğrenci Bilgisi</th>
                            <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Finansal Durum</th>
                            <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Hesap Statüsü</th>
                            <th class="px-8 py-5 text-right text-[10px] font-bold text-gray-400 uppercase tracking-widest">Yönetim</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                        <tr class="hover:bg-blue-50/10 transition">
                            <td class="px-8 py-6">
                                <div class="text-sm font-black text-gray-900">{{ $user->name }}</div>
                                <div class="text-xs text-gray-400">{{ $user->email }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-black text-blue-700 bg-blue-50 px-4 py-1 rounded-xl">
                                    {{ number_format($user->balance, 2) }} TL
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $user->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $user->status == 'active' ? 'Aktif' : 'Donduruldu' }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-3">
                                    <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST">
                                        @csrf
                                        <button class="text-xs font-bold text-blue-600 hover:underline">Dondur/Aç</button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:text-red-900 font-black text-[10px] uppercase italic">
        SİL
    </button>
</form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>