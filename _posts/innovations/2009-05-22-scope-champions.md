---
layout: article
date: 2009-05-22
permalink: innovations/scope-champions
label: Scope Champions
title: "Revolutionary Method Of Cost Estimating"
intro: "Learn how we optimize project cost estimating process using Scope Champions (our patent-pending invention)"
tags: innovations
description: |
  We invented a method of software cost estimating using a
  limited number of functional requirements, called Scope
  Champions. The method reduces the costs of estimating and
  increases accuracy. Full presentation of the method will be
  given on PROFES-09 conference in Oulu, Finland, on the 16th
  of June.
keywords:
  - cost estimating
  - cost estimate
  - cost estimating software
  - cost estimator
  - software cost estimation
  - project cost estimating
  - project cost
  - three-point estimate
  - function point estimate
  - COCOMO
  - funtion point analysis
  - class points
  - use case points
next_step: innovations/metrics
---

**Disclaimer**: This web page contains just an abstract of a research
report that was presented on [PROFES 2009](http://www.profes2009.org/) conference
in Oulu, Finland, on 16th of June, 2009. Materials of the conference are
published by Springer Verlag. The method is pending USPTO patent:
[12/193,010](http://www.google.com/patents/about?id=QjDNAAAAEBAJ).

Any project needs estimates (cost, time and resource) as key artifacts,
which are based on scope definition.
There are many well-established and proven methods of software size and
cost estimating, which are based on software specifications and
organizational assets, e.g. historical data. In a general case, any
method includes
(i) requirements analysis,
(ii) numbers deriving and
(iii) final calculation.

These three steps could be repeated several times iteratively, e.g. like in
[Wideband Delphi](http://en.wikipedia.org/wiki/Wideband_delphi).
Each step may be completed manually
or with a special tool and/or algorithm, e.g.
[function point analysis](http://en.wikipedia.org/wiki/Function_point_analysis),
[COCOMO](http://sunset.usc.edu/csse/research/COCOMOII/cocomo_main.html),
[PERT](http://en.wikipedia.org/wiki/Program_Evaluation_and_Review_Technique),
[XP user stories](http://en.wikipedia.org/wiki/User_story),
[SLOC](http://en.wikipedia.org/wiki/Source_lines_of_code) prediction, by analogies, with
[use case points](http://www.stsc.hill.af.mil/crosstalk/2006/02/0602Clemmons.pdf),
class points, neural networks, and others.

No matter what tools and algorithms are used, the whole process has
two significant disadvantages, which very often make it difficult
to achieve optimal results or even to finish the estimating in time.

First, even a mid-size software project may contain hundreds of functional
and non-functional requirements. The time required by estimators
for proper understanding and analysis of requirements almost always is much bigger than the budgeted
time for the whole estimating process. The obvious outcome of this situation is
a limited understanding of requirements by estimators, which leads to inaccuracy
in the estimators' judgement.

Second, estimators tend to approximate the numbers. With a big amount of
small estimates, this leads to a certain deviation in the final calculation (either
to the higher or to the lower boundary of the approximation). The
deviation grows much faster than the amount of the estimates does.

A good solution to the outlined problems is our innovative method that decreases
the amount of efforts required for deriving numbers, at the same time improving
the accuracy of the estimate.

## The Method of Scope Champions

In properly managed software projects, product scope is defined by software requirements specification
(SRS), that includes functional and non-functional requirements to the
product. A numbered list of requirements defines the boundary
of the product scope, while non-functional requirements supplement them
with quality attributes.

The method consists of three steps:
     1) select **Scope Champions**,
     2) estimate Scope Champions, and
     3) calculate the product scope estimate.

Scope Champion is a selected functional requirement,
the biggest and the most complex element of scope, according to
the estimators' expert judgement. Scope Champions are picked up from
a complete set of requirements on the same level of abstraction.

When Scope Champions are selected, isolated estimates for them
are made by estimators. Using the estimates and the formula, proposed as part of this
method, the final product scope estimate is calculated. The formula is:

{% tikz %}
\begin{center}
\begin{equation*}
Y \approx 0.54 \times \frac{n}{m} \times \sum_{i=1}^m Y_i
\end{equation*}
\end{center}
{% endtikz %}

Where **Y** are estimates of Scope Champions, **m** is
a total amount of Scope Champions, and **n** is the total amount of functional requirements
in SRS. **Y** is a final product scope estimate.

Accuracy of the final estimate is improved because:

 * the estimators judgement is based on more detailed analysis, and
 * the final estimate is much easier to validate and review.

The method can be used with other scope-defining artifacts, i.e. use case models, software
architecture, design model, test plan, and others.
The results obtained should be applied together, which will give higher accuracy
for the total.
