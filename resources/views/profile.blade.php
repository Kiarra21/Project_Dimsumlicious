@extends('layouts.app')

@section('title', 'Profile - Dimsumlicious')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100">
    
    <div class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
            <div class="text-center">
                <div class="flex flex-col items-center space-y-3">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-primary rounded-full flex items-center justify-center bounce-gentle">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 break-words">
                            Profile <span class="text-primary">{{ $username ?? 'Pengguna' }}</span>
                        </h1>
                        <p class="text-sm sm:text-base text-gray-600 mt-2">
                            Kelola informasi profil Anda
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
           
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-primary rounded-full flex items-center justify-center mx-auto mb-4 bounce-gentle">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 break-words px-2">{{ $userProfile['name'] }}</h2>
                        <p class="text-gray-600">{{ $userProfile['role'] }}</p>
                        <p class="text-sm text-gray-500 mt-2 break-words px-2">{{ $userProfile['bio'] }}</p>
                    </div>
                    
                    <div class="mt-6 space-y-4">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-3 bg-gray-50 rounded-lg gap-2">
                            <span class="text-sm text-gray-600 flex items-center flex-shrink-0">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Email
                            </span>
                            <span class="text-sm font-medium text-gray-900 break-all">{{ $userProfile['email'] }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-3 bg-gray-50 rounded-lg gap-2">
                            <span class="text-sm text-gray-600 flex items-center flex-shrink-0">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l-4 4m4-4l4 4m-4 0v10a2 2 0 01-2 2H8a2 2 0 01-2-2V11"/>
                                </svg>
                                Bergabung
                            </span>
                            <span class="text-sm font-medium text-gray-900">{{ date('d M Y', strtotime($userProfile['join_date'])) }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-3 bg-gray-50 rounded-lg gap-2">
                            <span class="text-sm text-gray-600 flex-shrink-0">🕒 Login Terakhir</span>
                            <span class="text-sm font-medium text-gray-900">{{ date('d M Y H:i', strtotime($userProfile['last_login'])) }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <button class="w-full bg-primary text-white py-3 px-4 rounded-lg hover:bg-secondary transition-colors duration-300 btn-animated">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Profile
                        </button>
                    </div>
                </div>
            </div>

           
            <div class="lg:col-span-2 space-y-6">
              
                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Pengaturan & Preferensi
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($userProfile['preferences'] as $key => $value)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                                <span class="text-sm text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}</span>
                                <span class="text-sm font-medium text-gray-900">{{ $value }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

               
                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Ringkasan Aktivitas
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-accent rounded-lg">
                                <div class="flex items-center space-x-2 sm:space-x-3 min-w-0">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    <span class="text-xs sm:text-sm font-medium text-gray-700 truncate">Posting Dibuat</span>
                                </div>
                                <span class="text-base sm:text-lg font-bold text-gray-900 ml-2">42</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-secondary rounded-lg">
                                <div class="flex items-center space-x-2 sm:space-x-3 min-w-0">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span class="text-xs sm:text-sm font-medium text-white truncate">Komentar</span>
                                </div>
                                <span class="text-base sm:text-lg font-bold text-white ml-2">128</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-highlight rounded-lg">
                                <div class="flex items-center space-x-2 sm:space-x-3 min-w-0">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                    </svg>
                                    <span class="text-xs sm:text-sm font-medium text-gray-700 truncate">Like Diterima</span>
                                </div>
                                <span class="text-base sm:text-lg font-bold text-gray-900 ml-2">256</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-primary rounded-lg">
                                <div class="flex items-center space-x-2 sm:space-x-3 min-w-0">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                    <span class="text-xs sm:text-sm font-medium text-white truncate">Pencapaian</span>
                                </div>
                                <span class="text-base sm:text-lg font-bold text-white ml-2">12</span>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Aksi Cepat
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button class="flex items-center p-4 bg-primary text-white rounded-xl hover:bg-secondary transition-all duration-300 btn-animated">
                            <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <div class="text-left">
                                <p class="font-medium">Ubah Password</p>
                                <p class="text-sm opacity-90">Perbarui kata sandi</p>
                            </div>
                        </button>
                        
                        <button class="flex items-center p-4 bg-secondary text-white rounded-xl hover:bg-accent transition-all duration-300 btn-animated">
                            <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div class="text-left">
                                <p class="font-medium">Ubah Email</p>
                                <p class="text-sm opacity-90">Perbarui alamat email</p>
                            </div>
                        </button>
                        
                        <button class="flex items-center p-4 bg-accent text-gray-700 rounded-xl hover:bg-highlight transition-all duration-300 btn-animated">
                            <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"/>
                            </svg>
                            <div class="text-left">
                                <p class="font-medium">Tema</p>
                                <p class="text-sm opacity-90">Ubah tema aplikasi</p>
                            </div>
                        </button>
                        
                        <button class="flex items-center p-4 bg-highlight text-gray-700 rounded-xl hover:bg-accent transition-all duration-300 btn-animated">
                            <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 002.828 0L12 7M4.828 17l2.586-2.586a2 2 0 012.828 0L12 17"/>
                            </svg>
                            <div class="text-left">
                                <p class="font-medium">Notifikasi</p>
                                <p class="text-sm opacity-90">Kelola notifikasi</p>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection