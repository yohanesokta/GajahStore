<?php $game = $data['game']; ?>
<div class="game-detail-container">
    <div class="game-header">
        <img src="/<?= htmlspecialchars($game['image_url']) ?>" alt="<?= htmlspecialchars($game['title']) ?>">
        <div class="game-info">
            <h1><?= htmlspecialchars($game['title']) ?></h1>
            <p><?= htmlspecialchars($game['genre']) ?> | <?= htmlspecialchars($game['platform_name']) ?></p>
            <div class="rating-summary">
                <span class="stars" style="--rating: <?= $data['avgRating'] ?>;" title="Average rating: <?= $data['avgRating'] ?> out of 5"></span>
                <span>(<?= $data['avgRating'] ?? 0 ?>/5.0) based on <?= $data['ratingCount'] ?> reviews</span>
            </div>
            <div class="price">Rp. <?= number_format($game['price']) ?></div>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" style="margin-top:10px;">Error: <?= htmlspecialchars($_GET['error']) ?></div>
            <?php endif; ?>

            <form action="/order/<?= $game['id'] ?>" method="POST" style="margin-top: 1.5rem;">
                <input type="hidden" name="amount" value="<?= $game['price'] ?>">
                <button type="submit" class="btn btn-primary">Top-up Now</button>
            </form>
        </div>
    </div>

    <div class="game-content" style="margin-top: 2rem;">
        <div class="reviews-section">
            <h2>Ratings & Reviews</h2>
            <div class="review-grid">
                <div class="review-form form-container" style="margin: 0;">
                    <h3>Leave Your Review</h3>
                    <?php if (isset($_GET['rated'])): ?>
                        <div class="alert alert-success">Thank you for your review!</div>
                    <?php endif; ?>
                     <?php if (isset($_GET['error']) && $_GET['error'] === 'rating_missing'): ?>
                        <div class="alert alert-danger">Please select a star rating.</div>
                    <?php endif; ?>
                    <form action="/rate/<?= $game['id'] ?>" method="POST">
                        <div class="form-group">
                            <label>Your Rating</label>
                            <div class="star-rating" style='display:flex; width:100%; justify-content:center;'>
                                <input type="radio" id="star5" name="rating" value="5" <?= ($data['userRating']['rating'] ?? 0) == 5 ? 'checked' : '' ?>/><label for="star5" title="5 stars">★</label>
                                <input type="radio" id="star4" name="rating" value="4" <?= ($data['userRating']['rating'] ?? 0) == 4 ? 'checked' : '' ?>/><label for="star4" title="4 stars">★</label>
                                <input type="radio" id="star3" name="rating" value="3" <?= ($data['userRating']['rating'] ?? 0) == 3 ? 'checked' : '' ?>/><label for="star3" title="3 stars">★</label>
                                <input type="radio" id="star2" name="rating" value="2" <?= ($data['userRating']['rating'] ?? 0) == 2 ? 'checked' : '' ?>/><label for="star2" title="2 stars">★</label>
                                <input type="radio" id="star1" name="rating" value="1" <?= ($data['userRating']['rating'] ?? 0) == 1 ? 'checked' : '' ?>/><label for="star1" title="1 star">★</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="review">Your Review (optional)</label>
                            <textarea id="review" name="review" rows="4" placeholder="Tell others what you think..."><?= htmlspecialchars($data['userRating']['review'] ?? '') ?></textarea>
                        </div>
                        <button type="submit" class="btn" style="width: 100%;">Submit Review</button>
                    </form>
                </div>

                <div class="review-list">
                    <?php if (empty($data['reviews'])): ?>
                        <p>No reviews yet. Be the first to review this game!</p>
                    <?php else: ?>
                        <?php foreach ($data['reviews'] as $review): ?>
                            <div class="review-card">
                                <div class="review-author"><strong><?= htmlspecialchars($review['user_name']) ?></strong></div>
                                <div class="review-rating">
                                    <span class="stars" style="--rating: <?= $review['rating'] ?>;"></span>
                                </div>
                                <?php if(!empty($review['review'])): ?>
                                <p class="review-text">
                                    <?= nl2br(htmlspecialchars($review['review'])) ?>
                                </p>
                                <?php endif; ?>
                                <div class="review-date" style="font-size: 0.8rem; color: var(--color-grey); text-align: right;"><?= date('d M Y', strtotime($review['created_at'])) ?></div>
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
