# Laravel Package Kurulumu ve Yayınlanması

Bu belge, `BabaSultan23/spatie-role-full-code` paketinin kurulumunu ve gerekli dosyaların nasıl yayımlanacağını
açıklamaktadır. Paket, **Spatie Laravel Permission** ve **Yajra Laravel Datatables** paketlerini içerir.

## Adımlar

1. **Paketi Composer ile Yükleyin**  
   İlk adım olarak, paketi Composer kullanarak yükleyin
   ```bash
   composer require babasultan23/spatie-role-full-code

2. **Vendor Dosyalarını Yayınlayın**  
   Paketi projeye yükledikten sonra, aşağıdaki komutları çalıştırarak gerekli dosyaları yayınlayabilirsiniz:
   ```bash
   php artisan vendor:publish --provider="BabaSultan23\\SpatieRoleFullCode\\SpatieRoleFullCodeServiceProvider"

##### Bu komut, paketinizin Controller, Helper, View ve Route dosyalarını yayımlayacaktır.

3. **Spatie Laravel Permission ve Yajra Laravel Datatables Dosyalarını Yayınlayın**

   ```bash
   php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
   php artisan vendor:publish --tag=datatables

4. **Migrasyonları Çalıştırın**

   ```bash
   php artisan migrate

## Kullanım

Artık paketinizi projede kullanmaya başlayabilirsiniz. Örneğin, `spatie-role-full-code` paketindeki view dosyalarını
kullanmak için aşağıdaki gibi çağrılar yapabilirsiniz:

    @include('spatie-role-full-code::system_setting')

    return view('spatie-role-full-code::role.index');

**Bu sayede tüm paket dosyaları düzgün şekilde yayımlanır ve projede kullanılabilir hale gelir.**