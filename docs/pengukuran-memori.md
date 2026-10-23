\# Pengukuran Memori: get() vs lazyById()



Dataset: 52.500 row pada tabel `transactions`.



| Cara baca data | Peak memory (MB) |

|---|---:|

| `Transaction::lazyById()` | 70.1 |

| `Transaction::get()` | 128.5 |



Kesimpulan Kelompok:

Berdasarkan hasil pengukuran pada 52.500 baris transaksi, metode `lazyById()` menggunakan peak memory sebesar 70,1 MB, sedangkan metode `get()` menggunakan 128,5 MB. Dengan demikian, `lazyById()` menggunakan memori sekitar 58,4 MB lebih rendah dibandingkan `get()` pada pengujian ini.

