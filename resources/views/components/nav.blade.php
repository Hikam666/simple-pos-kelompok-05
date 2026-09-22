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
</nav>