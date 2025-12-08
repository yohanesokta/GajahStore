<?php $game = $data['game']; ?>
<div class="game-detail-container">
    <div class="game-header">
        <img src="/<?= htmlspecialchars($game['URLGambar']) ?>" alt="<?= htmlspecialchars($game['Judul']) ?>">
        <div class="game-info">
            <h1><?= htmlspecialchars($game['Judul']) ?></h1>
            <p><?= htmlspecialchars($game['Genre']) ?> | <?= htmlspecialchars($game['NamaPlatform']) ?></p>
            <div class="rating-summary">
                <span class="stars" style="--rating: <?= $data['avgRating'] ?>;" title="Average rating: <?= $data['avgRating'] ?> out of 5"></span>
                <span>(<?= $data['avgRating'] ?? 0 ?>/5.0) based on <?= $data['ratingCount'] ?> reviews</span>
            </div>

            <div class="stock-info" style="margin-top: 1rem; font-size: 1.2rem;">
                <strong>Stok Tersedia:</strong> 
                <span style="font-weight: bold; color: <?= $data['stockCount'] > 0 ? 'green' : 'red' ?>;">
                    <?= htmlspecialchars($data['stockCount']) ?>
                </span>
            </div>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" style="margin-top:10px;">
                    <?php 
                        if ($_GET['error'] === 'no_stock') echo 'Maaf, stok kaset untuk game ini sudah habis.';
                        else echo 'Gagal membuat transaksi sewa.';
                    ?>
                </div>
            <?php endif; ?>

            <form action="/rent/<?= $game['IDGame'] ?>" method="POST" style="margin-top: 1.5rem;">
                <?php if ($data['stockCount'] > 0): ?>
                    <button type="submit" class="btn btn-primary">Sewa Sekarang</button>
                <?php else: ?>
                    <button type="button" class="btn btn-primary" disabled>Stok Habis</button>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="game-content" style="margin-top: 2rem;">
        <div class="reviews-section">
            <h2>Ratings & Reviews</h2>
            <div class="review-grid">
                <div class="review-form form-container" style="margin: 0;">
                    <h3>Tinggalkan Ulasan Anda</h3>
                    <?php if (isset($_GET['rated'])): ?>
                        <div class="alert alert-success">Terima kasih atas ulasan Anda!</div>
                    <?php endif; ?>
                     <?php if (isset($_GET['error']) && $_GET['error'] === 'rating_missing'): ?>
                        <div class="alert alert-danger">Harap pilih rating bintang.</div>
                    <?php endif; ?>
                    <form action="/rate/<?= $game['IDGame'] ?>" method="POST">
                        <div class="form-group">
                            <label>Rating Anda</label>
                            <div class="star-rating" style='display:flex; width:100%; justify-content:center;'>
                                <input type="radio" id="star5" name="rating" value="5" <?= ($data['userRating']['Skor'] ?? 0) == 5 ? 'checked' : '' ?>/><label for="star5" title="5 stars">★</label>
                                <input type="radio" id="star4" name="rating" value="4" <?= ($data['userRating']['Skor'] ?? 0) == 4 ? 'checked' : '' ?>/><label for="star4" title="4 stars">★</label>
                                <input type="radio" id="star3" name="rating" value="3" <?= ($data['userRating']['Skor'] ?? 0) == 3 ? 'checked' : '' ?>/><label for="star3" title="3 stars">★</label>
                                <input type="radio" id="star2" name="rating" value="2" <?= ($data['userRating']['Skor'] ?? 0) == 2 ? 'checked' : '' ?>/><label for="star2" title="2 stars">★</label>
                                <input type="radio" id="star1" name="rating" value="1" <?= ($data['userRating']['Skor'] ?? 0) == 1 ? 'checked' : '' ?>/><label for="star1" title="1 star">★</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="review">Ulasan Anda (opsional)</label>
                            <textarea id="review" name="review" rows="4" placeholder="Bagaimana menurut Anda game ini?"><?= htmlspecialchars($data['userRating']['Ulasan'] ?? '') ?></textarea>
                        </div>
                        <button type="submit" class="btn" style="width: 100%;">Kirim Ulasan</button>
                    </form>
                </div>

                <div class="review-list">
                    <?php if (empty($data['reviews'])): ?>
                        <p>Belum ada ulasan. Jadilah yang pertama mengulas game ini!</p>
                    <?php else: ?>
                        <?php foreach ($data['reviews'] as $review): ?>
                            <div class="review-card">
                                <div class="review-author"><strong><?= htmlspecialchars($review['NamaPengguna']) ?></strong></div>
                                <div class="review-rating">
                                    <span class="stars" style="--rating: <?= $review['Skor'] ?>;"></span>
                                </div>
                                <?php if(!empty($review['Ulasan'])): ?>
                                <p class="review-text">
                                    <?= nl2br(htmlspecialchars($review['Ulasan'])) ?>
                                </p>
                                <?php endif; ?>
                                <div class="review-date" style="font-size: 0.8rem; color: var(--color-grey); text-align: right;"><?= date('d M Y', strtotime($review['TglRating'])) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .review-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        align-items: flex-start;
    }
    @media (max-width: 992px) {
        .review-grid {
            grid-template-columns: 1fr;
        }
        .game-header {
            flex-direction: column;
        }
        .game-header img {
            width: 100%;
            max-width: 100%;
        }
    }
</style>

