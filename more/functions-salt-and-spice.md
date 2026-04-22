# The Salt and the Spice

## Introduction

This story is not here to decorate a programming lesson.

It is here to make a structural idea easier to see.

When people begin programming, they often learn isolated rules:
create functions, avoid duplication, name things well, use parameters, choose the right level of abstraction.

Each rule can be explained separately.
But in practice, they are not separate.

They are parts of the same problem:
how to give shape to repeated actions without confusing what is specific, what is generic, and what belongs at each level of the code.

This story uses salt, pepper, and spices to make those differences visible.

Its goal is to show, in a concrete and memorable way:

- why a repeated action deserves a name;
- why a good function name is not just a label, but a promise;
- why some actions deserve direct functions;
- why other cases require a generic function;
- why the same result can arrive through different interfaces, and why that difference matters;
- why implementation details should not automatically become calling rules;
- why code should stay faithful to the level of abstraction of the problem it is expressing.

In other words, this is a story about functions, but also about design.

It is about the difference between writing code that merely works and writing code that tells the truth about what it is doing.

The examples are simple on purpose.

The idea is not to teach kitchen logic.

The idea is to build an intuition that will still be useful later, when the names are no longer `salt()` and `spice($what)`, but real functions inside real programs.


# Part I — The Table

## 1. The Man Who Made His Own Salt

There was once a man who made his own salt every time he needed it.

Not literal salt, perhaps, but the kind of small repeated labor people keep rebuilding by hand because each instance seems too trivial to deserve a name.

Each meal, the same nuisance. Stop. Prepare. Measure. Return. Adjust. Resume. Nothing difficult. Just tedious enough to waste attention, and common enough to deserve better.

He worked like this:

```php
$water = fetch_water();
$minerals = fetch_minerals();
$brine = mix($water, $minerals);
$heat = boil($brine);
$salt = crystallize($heat);

season($dish, $salt);
````

Then the next meal came, and he did it again. And again.

This is how duplication begins: not with grandeur, but with annoyance.

## 2. The Salt Man

One evening he met a man whose whole trade was this: when someone needed salt, he brought salt.

He did not offer options. He did not open a catalog. He did not ask whether perhaps pepper would do.

He brought salt.

At first this seemed excessive. Why call a man for something so simple?

Then the cook noticed something important: the value was not in the salt. The value was in never having to solve salt again.

So he stopped making his own salt. When salt was needed, he called:

```php
salt();
```

And life became lighter.

## 3. When a Name Becomes a Promise

At first, the salt man was merely useful.

Then he was reliable.

Then trusted.

And after enough trust, his name ceased to describe a worker and began to describe a certainty.

If you called `salt()`, salt came.

That is when a function stops being convenience and becomes contract.

A vague function says, “something happens here.”

A good function says, “this exact thing happens here.”

A name, properly earned, becomes a promise.

## 4. The Pepper Man

In time, there was also a pepper man.

He too became known for one thing.

If you called:

```php
pepper();
```

pepper came.

Now the world had two trusted specialists.

Not because spices are mystical objects of software design, but because these two needs are common, stable, and always within reach.

They had become part of the table itself.

---

# Part II — The World Beyond the Table

## 5. The Limits of Specialization

But the world, being rude, refused to stop at salt and pepper.

One day someone wanted cumin. Another paprika. Another coriander. Another cinnamon. Then some obscure spice no one had ever requested before, and likely would not request again for months.

It would have been absurd to create a dedicated man and a dedicated name for every spice that might ever pass through a kitchen.

This is the limit of specialization.

Some things deserve their own door.

Some things do not.

## 6. The House of All Spices

So another service appeared.

Not a specialist. A system.

Its name was:

```php
spice($what);
```

You called, said what you wanted, and it was delivered.

For rare cases, it was excellent.

For unusual requests, it was necessary.

For the open-ended future of “whatever comes next,” it was the right design.

Now the world had both:

```php
salt();
pepper();
spice($what);
```

And this was not contradiction.

It was good architecture.

## 7. The Table Is Not a Warehouse

A certain reformer, who mistook generality for wisdom, looked at this arrangement and said:

“Why keep `salt()` and `pepper()` at all? `spice($what)` can handle everything.”

Technically, yes.

Practically, no.

For a restaurant table is not a warehouse.

You put salt and pepper on the table because they are the common interface.

You do not place beside the bread a cabinet of cumin, coriander, saffron, cinnamon, and every spice the future may invent.

Good design does not expose all possibility.

It exposes what is common, expected, and near at hand.

So salt and pepper remained on the table.

The rest went through the spice service.

## 8. The Difference Between a Door and a Desk

The reformer insisted:

“But what difference does it make? `spice('salt')` still gives salt.”

“Yes,” said the cook. “The same salt. But not the same interface.”

```php
salt();
```

is a door.

```php
spice('salt');
```

is a desk.

At the desk, you must specify what you want.

At the door, the request is already carried by the name.

The result may be identical.

The contract is not.

---

## 9. The Apprentice Asks the Ancient Question

Years later, an apprentice asked his master:

“Master, what is better: `salt()` or `spice('salt')`?”

The master replied, as masters often do when they are technically correct and not yet pedagogically useful:

“It depends on the context.”

The apprentice, who had hoped for a cleaner reward, asked more plainly:

“Is the salt different?”

The master said:

“No. It is the same salt. Often `spice` sends for `salt` behind the wall.”

The apprentice frowned.

“Why does it do that?”

Now the master made an old mistake.

He answered from recollection instead of from the learner’s need.

He spoke from the kitchen’s internal history, where routes and shortcuts had once mattered.

“It is faster,” he said.

This was a true word.

It was also a treacherous one.

## 10. The Secret Behind the Wall

The apprentice had now received an implementation detail and, like many beginners, mistook it for public guidance.

He reasoned:

If `spice('salt')` ends by calling `salt()`, then surely `salt()` is the better choice whenever salt is involved.

The master had spoken of what happened behind the wall.

The apprentice heard a rule for what should be written in the street.

This is a common danger in learning:

a fact about implementation is mistaken for a principle of design.

## 11. The Apprentice Applies the Lesson Too Soon

Soon he wrote this:

```php
foreach($spices_for_paella as $spice){
    if($spice === 'salt'){
        salt();
    }
    else{
        spice($spice);
    }
}
```

He believed he was being careful.

He had understood something real: one path might be shorter in one implementation.

What he had not understood was where such knowledge belongs.

At first the code merely looked clever.

Then the House of Spices added a ledger inside `spice($what)` so the pantry could track what had been requested.

Cumin passed through the ledger.

Paprika passed through the ledger.

Coriander passed through the ledger.

Salt did not.

The loop had begun to bypass the very service it claimed to use.

## 12. The Level of the Story

The master looked at the code, then at the pantry ledger, and asked:

“What story is this loop telling?”

The apprentice was silent.

The master pointed to the variable.

“This is `$spice`, not `$salt`.”

Then he pointed to the loop.

“This is not a story about one named request. It is a story about spice names arriving as data.”

And he explained:

When you stand outside the system and know directly that you need salt, call `salt()`.

When you stand outside the system and know directly that you need pepper, call `pepper()`.

But when spice names arrive through data, you are no longer in the world of direct named calls.

You are in the world of generic flow.

So the right expression was this:

```php
foreach($spices_for_paella as $spice){
    spice($spice);
}
```

Because that matches the shape of the problem.

The lesson was not about what happened underneath.

It was about remaining faithful to the level of the story the code was telling.

---

## 13. The Road That Fits the Journey

The apprentice, still resisting a little, asked:

“But if `spice('salt')` reaches `salt()`, why not shorten the path?”

The master replied:

“Because I answered you badly.”

The apprentice looked up.

“When I said ‘faster,’ I spoke of the kitchen’s internals, of an older arrangement behind the wall. You needed a rule for writing code, and I gave you a memory instead.”

Then he said it plainly:

When the need is directly known, use the direct function.

```php
salt();
pepper();
```

When the need comes through data, use the generic one.

```php
foreach($spices_for_paella as $spice){
    spice($spice);
}
```

Then he added:

“Otherwise every generic loop begins collecting private exceptions.

Today salt. Tomorrow pepper. Next week some other favored spice.

Soon the code no longer describes the data it is processing.

It begins gossiping about how the kitchen happens to be organized this season.”

And that is how abstraction rots:

not all at once,

but through small exceptions that flatter the writer and burden the code.

## 14. The Correction

So the apprentice erased his cleverness and wrote:

```php
foreach($spices_for_paella as $spice){
    spice($spice);
}
```

Now the loop said exactly what it was doing.

The pantry ledger remained whole.

The code no longer cared how the spice house fulfilled each request.

If tomorrow `spice()` stopped calling `salt()` internally, the loop would not need to change.

And this time the master nodded.

Not because it was faster.

Because it was faithful.

Faithful to the level of abstraction.

Faithful to the shape of the data.

Faithful to the contract the code was meant to honor.

## 15. What the Apprentice Wrote in His Notebook

That evening, the apprentice wrote:

A repeated task deserves a name.

A good name becomes a promise.

Some needs are common and stable enough to deserve direct functions.

Some needs are variable enough to deserve a generic function.

The same result may arrive through different interfaces, and interface matters.

When the need is directly known, call the direct function.

When the need comes through data, call the generic one.

Do not let private knowledge of implementation leak into public calling code.

A fact about how something is implemented is not automatically a rule about how it should be used.

And, outside the kitchen, this is the same in programming:

specific helpers belong where the action is directly named;

generic interfaces belong where actions arrive as data.

The same salt may arrive by many roads.

Wisdom is choosing the road that fits the journey.
