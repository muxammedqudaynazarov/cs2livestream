@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 py-8 font-sans">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tight">
                    Taza komanda jaratıw
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Turnirlerde qatnasıw ushın komandańızdıń maǵlıwmatların kiritiń.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="p-8">
                        <div class="flex flex-col items-center justify-center mb-10">
                            <div class="relative group cursor-pointer"
                                 onclick="document.getElementById('logo-input').click()">
                                <div
                                    class="w-32 h-32 rounded-full overflow-hidden bg-slate-100 border-2 border-dashed border-slate-300 group-hover:border-blue-500 transition-colors flex items-center justify-center relative shadow-sm">
                                    <div id="logo-placeholder"
                                         class="flex flex-col items-center justify-center text-slate-400 group-hover:text-blue-500 transition-colors">
                                        <i class="fa-solid fa-camera text-3xl mb-1"></i>
                                        <span class="text-[10px] font-bold uppercase tracking-widest">LOGO</span>
                                    </div>
                                    <img id="logo-preview" src="#" alt="Logo Preview"
                                         class="absolute inset-0 w-full h-full object-cover hidden">
                                    <div
                                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i class="fa-solid fa-pen text-white text-xl"></i>
                                    </div>
                                </div>
                            </div>

                            <input type="file" id="logo-input" name="logo"
                                   accept="image/png, image/jpeg, image/jpg" class="hidden">
                            <p class="text-xs text-slate-400 mt-3 text-center">
                                Súwret kólemi 1000x1000 px, PNG yamasa JPG.<br>Maksimal 2MB bolıwı usınıs etiledi.
                            </p>
                            @error('logo')
                            <span class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="name"
                                       class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Komanda ataması
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                       placeholder="Mısalı ushın: Wolves" required
                                       class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-colors">
                                @error('name') <span
                                    class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="tag"
                                       class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Qısqa ataması (teg)
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="tag" name="tag" value="{{ old('tag') }}" placeholder="WLV"
                                       required maxlength="3" oninput="this.value = this.value.toUpperCase()"
                                       class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-colors uppercase font-black tracking-widest">
                                @error('tag')
                                <span class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="from"
                                       class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Qatnasıw forması
                                    <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select id="from_id" name="from_id" required
                                            class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-lg px-4 py-3 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-colors">
                                        <option value="" disabled selected>Qatnasıw formasın tańlań...</option>
                                        @foreach($universities as $university)
                                            <option
                                                value="{{ $university->id }}" {{ old('from_id') == $university->id ? 'selected' : '' }}>
                                                {{ $university->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                        <i class="fa-solid fa-chevron-down text-sm"></i>
                                    </div>
                                </div>
                                @error('from_id') <span
                                    class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="px-8 py-5 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                        <a href="{{ route('teams.index') }}"
                           class="px-6 py-2.5 rounded-lg text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                            Bekor qilish
                        </a>
                        <button type="submit"
                                class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-bold shadow-sm transition-all active:scale-95 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Saqlash
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const logoInput = document.getElementById('logo-input');
            const logoPreview = document.getElementById('logo-preview');
            const logoPlaceholder = document.getElementById('logo-placeholder');

            logoInput.addEventListener('change', function (event) {
                const file = event.target.files[0];

                if (file) {
                    // Faylni o'qish uchun FileReader obyekti
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        // O'qilgan rasmni prevyu img tagiga joylash
                        logoPreview.src = e.target.result;
                        // Prevyuni ko'rsatish
                        logoPreview.classList.remove('hidden');
                        // Kamera ikonkasi va yozuvni yashirish
                        logoPlaceholder.classList.add('hidden');
                    };

                    // Faylni Data URL sifatida o'qishni boshlash
                    reader.readAsDataURL(file);
                } else {
                    // Agar fayl tanlanmasa, asl holatiga qaytarish
                    logoPreview.src = '#';
                    logoPreview.classList.add('hidden');
                    logoPlaceholder.classList.remove('hidden');
                }
            });
        });
    </script>
@endsection
