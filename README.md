<h1>مستندات</h1>

<div dir="ltr" style="margin-bottom:10px">
    <code style="padding:5px 15px;">git clone https://github.com/alipiri/saba-idea.git && cd saba-idea</code>
</div>
<ul>
    <li style="margin-bottom:10px">
    <span>با استفاده از این دستور پروژه را اجرا کنید</span>
        <code style="padding:5px 15px;margin: 0 5px">docker-compose up -d --build</code>
    </li>
    <li style="margin-bottom:10px">
        از فایل .env.example برای ایجاد .env  استفاده کنید
    </li>
    <li style="margin-bottom:10px">
    <span>با استفاده از این دستور جداول را ایجاد کنید</span>
        <code style="padding:5px 15px;margin: 0 5px">docker exec -it app php artisan migrate</code>
    </li>
    <li style="margin-bottom:10px">
    <span>با استفاده از این دستور دیتای فیک ایجاد کنید</span>
        <code style="padding:5px 15px;margin: 0 5px">docker exec -it app php artisan db:seed</code>
    </li>
    <li>API های پروژه در کالکشن postman در روت پروژه قرار گرفته است</li>
    <li>توضیحات validation هر کدام از متغیرها در بخش description نوشته شده است</li>
</ul>