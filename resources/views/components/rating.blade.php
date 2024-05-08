@if($readOnly)
<div x-data="
	{
		rating: {{$rate}},
		hoverRating: {{$rate}},
		ratings: [{'amount': 1}, {'amount': 2}, {'amount': 3}, {'amount': 4}, {'amount': 5}],
		rate(amount) {
			if (this.rating == amount) {
        this.rating = 0;
      }
			else this.rating = amount;
		},
    currentLabel() {
       let r = this.rating;
      if (this.hoverRating != this.rating) r = this.hoverRating;
      let i = this.ratings.findIndex(e => e.amount == r);
      if (i >=0) {return this.ratings[i].label;} else {return ''};     
    }
	}
	" class="tw-flex tw-items-center">
    <template x-for="(star, index) in ratings" :key="index">
        <button type="button" aria-hidden="true" class="tw-border-none tw-outline-none tw-bg-transparent tw-text-gray-400 tw-fill-current tw-focus:outline-none tw-focus:shadow-outline p-0 tw-mx-1 tw-cursor-pointer" :class="{'text-warning': hoverRating >= star.amount, 'text-light-warning': rating >= star.amount}">
            <i class="fa-solid fa-star"></i>
        </button>

    </template>
    <input type="hidden" x-model="rating" />
</div>
@else
<div x-data="
	{
		rating: 0,
		hoverRating: 0,
		ratings: [{'amount': 1}, {'amount': 2}, {'amount': 3}, {'amount': 4}, {'amount': 5}],
		rate(amount) {
			if (this.rating == amount) {
        this.rating = 0;
      }
			else this.rating = amount;
		},
    currentLabel() {
       let r = this.rating;
      if (this.hoverRating != this.rating) r = this.hoverRating;
      let i = this.ratings.findIndex(e => e.amount == r);
      if (i >=0) {return this.ratings[i].label;} else {return ''};     
    }
	}
	" class="tw-flex tw-items-center">
    <template x-for="(star, index) in ratings" :key="index">
        <button type="button" @click="rate(star.amount)" @mouseover="hoverRating = star.amount" @mouseleave="hoverRating = rating" aria-hidden="true" :title="star.label" class="tw-border-none tw-outline-none tw-bg-transparent tw-text-gray-400 tw-fill-current tw-focus:outline-none tw-focus:shadow-outline p-0 tw-mx-1 tw-cursor-pointer" :class="{'text-primary': hoverRating >= star.amount, 'text-light-warning': rating >= star.amount && hoverRating >= star.amount}">
            <i class="fa-solid fa-star"></i>
        </button>

    </template>
    <input type="hidden" name="{{$name}}" x-model="rating" />
</div>
@endif