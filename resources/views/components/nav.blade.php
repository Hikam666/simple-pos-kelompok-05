<nav class="bg-slate-900 text-white px-4 py-3">
    <div style="display: flex; align-items: center;">

        <span class="font-semibold text-lg">
            Simple POS
        </span>

        <a href="{{ route('pos.create') }}"
           style="margin-left: 30px;"
           class="{{ request()->routeIs('pos.create') ? 'text-white underline' : 'hover:text-blue-400 hover:underline' }}">
            Kasir
        </a>

        <a href="{{ route('transactions.index') }}"
           style="margin-left: 30px;"
           class="{{ request()->routeIs('transactions.index') ? 'text-white underline' : 'hover:text-blue-400 hover:underline' }}">
            Transaksi
        </a>

    </div>
    <a href="{{ route('products.index') }}" class="hover:underline">Produk</a>
</nav>
<nav class="bg-slate-900 text-white px-4 py-3 flex gap-4 items-center">
    <span class="font-semibold">Simple POS</span>
    <a href="{{ route('pos.create') }}" class="hover:underline">Kasir</a>
    <a href="{{ route('transactions.index') }}" class="hover:underline">Transaksi</a>
    @if (auth()->user()?->isAdmin())
        <a href="{{ route('products.index') }}" class="hover:underline">Produk</a>
        <a href="{{ route('categories.index') }}" class="hover:underline">Kategori</a>
    @endif
    <span class="ml-auto text-sm">{{ auth()->user()?->name }} ({{ auth()->user()?->role }})</span>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="hover:underline">Keluar</button>
    </form>
</nav>